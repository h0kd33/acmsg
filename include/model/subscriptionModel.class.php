<?php
defined('ACC')||die('ACC Denied');

class subscriptionModel extends model{
	//table:'subscription'
	public function add($tid) {
		$data = array();
		$data['tid'] = $tid;
		$data['uid'] = $_SESSION['uid'];
		return $this->db->autoexecute('subscription', $data);
	}
	public function del($tid) {
		$sql = 'delete from subscription where uid='.$_SESSION['uid'].' and tid='.$tid;
		return $this->db->query($sql);
	}
	public function get($start, $num=10) {
		$sql = "select * from thread where tid in (select tid from subscription where uid={$_SESSION['uid']}) order by lastreptime desc limit $start,$num";
		return $this->db->getAll($sql);
	}
	public function count() {
		$sql = 'select count(*) from subscription where uid='.$_SESSION['uid'];
		return $this->db->getOne($sql);
	}
	public static function isSubscribed($tid) {
		$conf = conf::getInstance();
		if ($conf->use_mysqli) {
			$db = mysql_::getInstance();
		} else {
			$db = mysql::getInstance();
		}
		$sql = 'select count(*) from subscription where uid='.$_SESSION['uid'].' and tid='.$tid;
		return $db->getOne($sql)>0;
	}
}