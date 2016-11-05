<?php
/*
file mysql.class.php
mysql操作类
 */

defined('ACC')||exit('ACC Denied');
class mysql extends db{

	protected static $ins = null;
	protected $conn;
	protected function __construct() {
		$conf = conf::getInstance();
		$this->conn = mysql_connect($conf->host, $conf->user, $conf->pass);
		if(!$this->conn) {
			if (SAVELOG){
				log::write(date('Y-m-d H:i:s', time()) . ' mysql connect error: ' . mysql_error());
			}
		    showMsg('数据库连接失败！');
		}
		$this->query('use ' . $conf->db);
		$this->query('set names ' . $conf->charset);
	}

	//设置对象不可克隆
	final protected function __clone() {}

	//对象销毁即关闭数据库连接
	public function __destruct(){
		if ($this->conn) {
			mysql_close($this->conn);
		}
	}
	//获取一个实例
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
		return mysql_query($sql, $this->conn);
	}

	/*
	查询多行数据
	parms $sql sql语句
	return array/bool
	*/
	public function getAll($sql) {
		$results = $this->query($sql);
		$all = array();
		if (!$results) {
			return false;
		}
		while ($row = mysql_fetch_assoc($results)) {
			$all[] = $row;
		}
		mysql_free_result($results);
		return $all;
	}

	/*
	查询单行数据
	parms $sql select型语句
	return array/bool
	*/
	public function getRow($sql) {
		$results = $this->query($sql);
		if (!$results) {
			return false;
		}
		$row = mysql_fetch_assoc($results);
		mysql_free_result($results);
		return $row;
	}

	/*
	查询单个数据
	parms $sql select型语句
	return mixed/bool
	*/
	public function getOne($sql) {
		$results = $this->query($sql);
		if (!$results) {
			return false;
		}
		$row = mysql_fetch_row($results);
		mysql_free_result($results);
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
