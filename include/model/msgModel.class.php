<?php
/*
file msgModel.class.php
留言板操作类
*/
defined('ACC')||exit('ACC Denied');

class msgModel extends model {
	//过滤用户提交正文
	protected function filterCout($cont) {
		$cont = htmlspecialchars($cont);
		$cont = preg_replace('/(\r\n|\r|\n)/', '<br />', $cont);
		$cont = preg_replace('/&gt;&gt;\d+(&gt;\d+)?/', '<span class=\"quote\">$0</span>', $cont);
		return $cont;
	}

	//过滤用户提交标题
	protected function filterTitle($title) {
		$title = htmlspecialchars($title);
		$title = preg_replace('/(\r\n|\r|\n)/', '', $title);
		$title = mb_substr($title, 0, 30, 'utf-8');
		return $title;
	}

	/*
		修改主题
		prams int		$tid
		prams int		$cat
		prams string	$title
		prams string	$content
		return bool
	 */
	public function editThread ($tid, $cat, $title, $content) {
		$title = $this->filterTitle($title);
		$content = $this->filterCout($content);
		$sql = "update thread set cat=$cat,title='$title',content='$content' where tid=$tid";
		return $this->db->query($sql);
	}

	/*
		修改回复
		prams int		$tid
		prams int		$f
		prams string	$content
		return bool
	 */
	public function editReply ($tid, $f, $content) {
		$content = $this->filterCout($content);
		$sql = "update reply set content='$content' where tid=$tid and floor=$f";
		return $this->db->query($sql);
	}

	/*
		返回指定栏目下指定数量范围新发布主题
		parms int $start	开始位置
		parms int $num		获取数量
		return array
	 */
	public function getTopThreads($start, $cat_id=0, $num=10) {
		$sql = 'select * from thread where cat in ('.implode(',', catModel::getCatTreeId($cat_id)).') order by lastreptime desc limit '.$start.','.$num;
		return $this->db->getAll($sql);
	}

	/*
		返回指定tid主题
		parms int $tid
		return array
	 */
	public function getThread($tid) {
		$sql = "select * from thread where tid=$tid";
		return $this->db->getRow($sql);
	}

	/*
		删除指定tid主题及该主题所有回复
		parms int $tid
		return array(bool,bool)
	 */
	public function delThread($tid) {
		$re = array();
		//删除主题
		$sql = "delete from thread where tid=$tid";
		$re[] = $this->db->query($sql);
		//删除回复
		$sql = "delete from reply where tid=$tid";
		$re[] = $this->db->query($sql);
		return $re;
	}

	/*
		返回指定tid及楼层回复
		parms int	$rid
		parms int	$floor
		return array
	 */
	public function getReply($tid, $floor) {
		$sql = "select * from reply where tid=$tid and floor=$floor";
		return $this->db->getRow($sql);
	}

	/*
		删除指定tid和楼层的回复
		parms int	$rid
		parms int	$floor
		return bool
	 */
	public function delReply($tid, $floor) {
		$sql = "delete from reply where tid=$tid and floor=$floor";
		return $this->db->query($sql);
	}

	/*
		返回指定主题指定数量范围新发布回复
		parms int $tid		被回复主题tid
		parms int $start	开始位置
		parms int $num		最大数量
		return array
	 */
	public function getTopReplies($tid, $start, $num=5) {
		$sql = "select * from reply where tid=$tid order by rid desc limit $start,$num";
		return $this->db->getAll($sql);
	}

	/*
		返回指定主题下一楼层数
		parms int $tid		主题tid
		return int
	 */
	public function getNextFloor($tid){
		$sql = "select floor from reply where tid=$tid order by rid desc limit 0,1";
		$r = $this->db->getOne($sql);
		$r = !$r?1:$r+1;
		return $r;
	}

	/*
		返回指定主题指定数量范围顺序发布回复
		parms int $tid		被回复主题tid
		parms int $start	开始位置
		parms int $num		最大数量
		return array
	 */
	public function getReplies($tid, $start, $num=5) {
		$sql = "select username,content,reptime from reply where tid=$tid limit $start,$num";
		return $this->db->getAll($sql);
	}

	/*
		获取主题数量
		prams int	$cat
		return int
	 */
	public function countThreads($cat) {
		$cat = catModel::getCatTreeId($cat);
		$sql = 'select count(*) from thread where cat in ('.implode(',', $cat).')';
		return $this->db->getOne($sql);
	}

	/*
		获取回复数量
		parms int $tid		被回复主题tid
		return int
	 */
	public function countReplies($tid) {
		$sql = "select count(*) from reply where tid=$tid";
		return $this->db->getOne($sql);
	}

	/*
		获取指定用户主题数量
		parms int $uid		被用户uid
		return int
	 */
	public function countUserThreads($uid) {
		$sql = "select count(*) from thread where uid=$uid";
		return $this->db->getOne($sql);
	}

	/*
		获取指定用户发送主题
		parms int $uid		被用户uid
		prams int $start	开始位置
		prams int $num		最大数量
		return int
	 */
	public function getUserThreads($uid, $start, $num=5) {
		$sql = "select * from thread where uid=$uid order by tid desc limit $start,$num";
		return $this->db->getAll($sql);
	}

	/*
		获取指定用户回复数量
		parms int $uid		被用户uid
		return int
	 */
	public function countUserReplies($uid) {
		$sql = "select count(*) from (select distinct tid from reply where uid=$uid)tids";
		return $this->db->getOne($sql);
	}

	/*
		获取指定用户发送的回复及所在主题
		parms int $uid		被用户uid
		prams int $start	开始位置
		prams int $num		最大数量
		return int
	 */
	public function getUserReplies($uid, $start, $num=5) {
		$sql = "select distinct tid from reply where uid=$uid order by tid desc limit $start,$num";
		$tids = $this->db->getAll($sql);
		$threads = array();
		foreach ($tids as $v) {
			$t = $this->getThread($v['tid']);
			$sql2 = "select * from reply where uid=$uid and tid={$v['tid']} order by rid desc";
			$t['replies'] = $this->db->getAll($sql2);
			$threads[] = $t;
		}
		return $threads;

	}

	/*
		增加新主题
		parms array $data 格式['cat'=>'栏目id','uid=>'用户uid','name'=>'昵称','title'=>'标题','content'=>'发布内容']
	 */
	public function addThread($data) {
		$data['content'] = $this->filterCout($data['content']);
		$data['title'] = $this->filterTitle($data['title']);
		$data['pubtime'] = time();
		$data['lastreptime'] = $data['pubtime'];
		return $this->db->autoExecute('thread', $data);
	}

	/*
		增加新回复
		parms array $data 格式['tid'=>0,'uid=>'用户uid'',name'=>'昵称','content'=>'发布内容']
		return bool
	 */
	public function addReply($data) {
		$data['content'] = $this->filterCout($data['content']);
		$data['reptime'] = time();
		if (!$this->isSAGE($data['tid'])) {
			$sql = 'update thread set lastreptime='.$data['reptime'].' where tid='.$data['tid'];
			$this->db->query($sql);
		}
		return $this->db->autoExecute('reply', $data);
	}

	/*
		查询指定主题是否SAGE
		parms int $tid
		return bool
	 */
	public function isSAGE($tid) {
		$sql = 'select SAGE from thread where tid='.$tid;
		return !!$this->db->getOne($sql);
	}

	/*
		SAGE指定主题(该主题将不会因新回复而被顶到页首)
		parms int $tid
		return bool
	 */
	public function SAGE($tid) {
		$sql = 'update thread set SAGE=1 where tid='.$tid;
		return $this->db->query($sql);
	}

	/*
		解除SAGE指定主题(该主题将会因新回复而被顶到页首)
		parms int $tid
		return bool
	 */
	public function UNSAGE($tid) {
		$sql = 'update thread set SAGE=0 where tid='.$tid;
		return $this->db->query($sql);
	}

}
