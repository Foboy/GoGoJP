<?php
namespace Common\Common;

class NovComet {
    const COMET_OK = 0;
    const COMET_CHANGED = 1;

    private $_tries;
    private $_var;
    private $_sleep;
    private $_ids = array();
    private $_callback = null;

    public function  __construct($tries = 10, $sleep = 1)
    {
        $this->_tries = $tries;
        $this->_sleep = $sleep;
    }

    public function setVar($key, $value)
    {
        $this->_vars[$key] = $value;
    }

    public function setTries($tries)
    {
        $this->_tries = $tries;
    }

    public function setSleepTime($sleep)
    {
        $this->_sleep = $sleep;
    }

    public function setCallbackCheck($callback)
    {
        $this->_callback = $callback;
    }

    const DEFAULT_COMET_PATH = "Comets/%s.comet";

    public function run() {
        if (is_null($this->_callback)) {
            $defaultCometPAth = self::DEFAULT_COMET_PATH;
            $callback = function($id) use ($defaultCometPAth) {
                $cometFile = sprintf($defaultCometPAth, $id);
                return (is_file($cometFile)) ? filemtime($cometFile) : 0;
            };
        } else {
            $callback = $this->_callback;
        }
        $out = array();
        for ($i = 0; $i < $this->_tries; $i++) {
            foreach ($this->_vars as $id => $timestamp) {
                if ((integer) $timestamp == 0) {
                    $timestamp = time();
                }
                $fileTimestamp = $callback($id);
                if ($fileTimestamp > $timestamp) {
                    $out[$id] = $fileTimestamp;
                }
                clearstatcache();
            }
            if (count($out) > 0) {
            	$data = array();
            	foreach ($out as $id => $timestamp) {
	            	$cometFile = sprintf($defaultCometPAth, $id);
	            	if(is_file($cometFile))
	            	{
	            		$fp = fopen($cometFile, "a+");
	            		flock($fp, LOCK_EX);
	            		$str = fread($fp, filesize($cometFile));
	            		$data[$id] = $str;
	            		ftruncate($fp,0);
	            		flock($fp, LOCK_UN);
	            		fclose($fp);
	            	}
	            	clearstatcache();
	            	$out[$id] = $callback($id);
            	}
                return json_encode(array('s' => self::COMET_CHANGED, 'k' => $out,'d'=>$data));
            }
            sleep($this->_sleep);
        }
        return json_encode(array('s' => self::COMET_OK));
    }

    public function publish($id,$data)
    {
    	file_put_contents(sprintf(self::DEFAULT_COMET_PATH, $id),$data,FILE_APPEND|LOCK_EX);
    	return 'true';
        //return json_encode(touch(sprintf(self::DEFAULT_COMET_PATH, $id)));
    }
}
