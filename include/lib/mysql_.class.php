<?php

class mysql_ extends db{
	protected static $ins = null;
	protected $mysqli;

	protected function __construct() {
		if (!class_exists('mysqli')) {
			showMsg('服务器空间PHP不支持MySqli函数');
		}
		$conf = conf::getInstance();
		$this->mysqli = new mysqli($conf->host, $conf->user, $conf->pass, $conf->db);
		if ($this->mysqli->connect_error) {
			if (SAVELOG){
				log::write(date('Y-m-d H:i:s', time()) . ' mysql connect error: ' . $this->mysqli->connect_error);
			}
			showMsg('数据库连接失败！');
		}
		$this->mysqli->set_charset($conf->charset);
	}

	public function __destruct() {
		if (!$this->mysqli->connect_error) {
			$this->mysqli->close();
		}
	}

	final protected function __clone() {}

	/**
	 * 静态方法，返回数据库连接实例
	 */
	public static function getInstance() {
		if (self::$ins == null) {
			self::$ins = new self;
		}
		return self::$ins;
	}

	/*
	发送查询
	parms $sql sql语句
	return mixed bool/resource
	*/
	public function query($sql) {
		if (SAVELOG){
			log::write(date('Y-m-d H:i:s', time()) . ' mysql query: ' . $sql);
		}
		return $this->mysqli->query($sql);
	}

	/*
	查询多行数据
	parms $sql select型语句
	return array
	*/
	public function getAll($sql) {
		$results = $this->query($sql);
		$all = array();
		while ($row = $results->fetch_assoc()) {
			$all[] = $row;
		}
		$results->free();
		return $all;
	}

	/*
	查询单行数据
	parms $sql select型语句
	return array
	*/
	public function getRow($sql) {
		$results = $this->query($sql);
		if (!$results) {
			return false;
		}
		$row = $results->fetch_assoc();
		$results->free();
		return $row;
	}

	/*
	查询单个数据
	parms $sql select型语句
	return mixed
	*/
	public function getOne($sql) {
		$results = $this->query($sql);
		if (!$results) {
			return false;
		}
		$row = $results->fetch_row();
		$results->free();
		return isset($row[0])?$row[0]:false;
	}

	/*
	自动执行insert/update语句
	parms	string	$table	要执行sql语句的表名
	parms	array	$data	要更新或插入的数据
	parms	string	$act	要执行的动作 'insert'/'update'
	parms	string	$where	where语句
	return bool
	*/
	public function autoExecute($table,$data,$act='insert',$where='') {
		$sql = '';
		if (strtolower($act) == 'insert') {
			$sql = 'insert into ' . $table . ' (' . implode(',', array_keys($data)) . ') values (\''.
					implode('\',\'', array_values($data)) . '\')';
		} elseif (strtolower($act) == 'update') {
			$sql = 'update ' . $table . ' set ';
			foreach ($data as $key => $value) {
				$sql .= $key.'=\''.$value.'\','; 
			}
			$sql = rtrim($sql,',');
			$sql .= ' where '.$where;
		}
		return $this->query($sql);
	}



}