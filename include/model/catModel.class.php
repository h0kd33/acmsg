<?php
/*
file CatModel.class.php
栏目操作类
*/
defined('ACC')||exit('ACC Denied');
class CatModel {
	protected static $db = NULL;
	public static $cats = NULL;

	public static function get() {
		$conf = conf::getInstance();
		if ($conf->use_mysqli) {
			is_null(self::$db)&&self::$db = mysql_::getInstance();
		} else {
			is_null(self::$db)&&self::$db = mysql::getInstance();
		}
		is_null(self::$cats)&&self::$cats=self::$db->getAll('select id,cat_name,parent_id from category');
	}

	/*
		栏目添加
		fucntion add
		pram: array	$data	格式: ['cat_name'=>'栏目名','intro'=>'栏目介绍','parent_id'=>'父栏目id']
		return bool
	 */
	public static function add($data) {
		self::get();
		return self::$db->autoExecute('category', $data);
	}

	/*
		获取栏目信息
		function getInfo
		pram: int	$id			栏目id
		pram: bool	$getIntro	是否获取栏目简介
		return string/bool
	 */
	public static function getInfo($id, $getIntro=true) {
		self::get();
		$columns = $getIntro?'cat_name,intro':'cat_name';
		$sql = 'select '.$columns.' from category where id='.$id;
		return self::$db->getRow($sql);
	}
	
	/*
		无限分类——取得所有子类——迭代版本
		function getCatTree
		pram: int	$id
		return array	$id栏目的子孙树
	 */
	public static function getCatTree($cid=0) {
		self::get();
		$arr = self::$cats;
		$sons = array();
		$id = array();
		$id[] = $cid;
		$done = false;
		while (!$done) {
			$done = true;
			foreach ($arr as $key => $val) {
				if ($val['parent_id'] == $id[0]) {
					unset($arr[$key]);
					$done = false;
					$val['lev'] = count($id)-1;
					$sons[] = $val;
					array_unshift($id, $val['id']);
					break;
				} elseif (end($arr) == $val&&count($id) > 1) {
					array_shift($id);
					$done = false;
				}
			}
		}
		return $sons;
	}

	/*
		取得所有子类id
		function getCatTreeId
		pram: int	$id
		return array	子类id数组
	 */
	public static function getCatTreeId($id=0) {
		$arr = self::getCatTree($id);
		$sons = array();
		$sons[] = $id;
		foreach ($arr as $val) {
			$sons[] = $val['id'];
		}
		return $sons;
	}

}
