<?php

namespace Common\Common;

use Common\Common\DataResult;

class PageDataResult extends DataResult {
	public $pageindex;
	public $pagesize;
	public $totalcount;
	public $Data;
	public function __construct() {
		$this->Error = ErrorType::Success;
	}
}
?>