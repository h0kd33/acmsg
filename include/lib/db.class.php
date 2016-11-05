<?php
/*
file db.class.php
数据库抽象类
 */

defined('ACC')||exit('ACC Denied');
abstract class db {

	/*
	发送查询
	parms $sql sql语句
	return mixed bool/resource
	*/
	public abstract function query($sql);

	/*
	查询多行数据
	return array/bool
	*/
	public abstract function getAll($sql);

	/*
	查询单行数据
	prams $sql select型语句
	return array/bool
	*/
	public abstract function getRow($sql);

	/*
	查询单个数据
	prams $sql select型语句
	return array/bool
	*/
	public abstract function getOne($sql);

	/*
	自动执行insert/update语句
	prams $sql select型语句
	return array/bool
	*/
	public abstract function autoExecute($table,$data,$act='insert',$where='');


}
