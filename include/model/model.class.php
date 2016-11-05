<?php
/*
file model.class.php
Model基类
*/

defined('ACC')||exit('ACC Denied');
class model {
	protected $table = NULL;
	protected $db = NULL;
	public function __construct() {
		$conf = conf::getInstance();
		if ($conf->use_mysqli) {
			$this->db = mysql_::getInstance();
		} else {
			$this->db = mysql::getInstance();
		}
	}
	public function table($table) {
		$this->table = $table;
	}
	
}
