<?php
	defined('ACC')||exit('ACC Denied');
	$url = $_SERVER['SCRIPT_NAME'];
	$query = explode('&', $_SERVER['QUERY_STRING']);
	foreach ($query as $key => $val) {
		if (substr($val, 0, 4) === 'page'||$val === '') {
			unset($query[$key]);
		}
	}
	$query[] = '';
	$query = implode('&', $query);
	$url = $url.'?'.$query;
?>
<ul class="pagination pagination-sm">
	<?php 
	if ($curr_page==1){
		echo '<li class="disabled"><a>到第一页</a></li>';
		echo '<li class="disabled"><a>«上一页</a></li>';
	} else {
		echo '<li><a href="'.$url.'page=1">到第一页</a></li>';
		echo '<li><a href="'.$url.'page='.($curr_page-1).'">«上一页</a></li>';
	}
	for (; $i<=$show; $i++) {
		if ($i==$curr_page) {
			echo '<li class="active"><a>'.$i.'</a></li>';
			continue;
		}
		echo '<li><a href="'.$url.'page='.$i.'">'.$i.'</a></li>';
	}
	if ($curr_page>=$all) {
		echo '<li class="disabled"><a>下一页»</a></li>';
		echo '<li class="disabled"><a>最后一页</a></li>';
	} else {
		echo '<li><a href="'.$url.'page='.($curr_page+1).'">下一页»</a></li>';
		echo '<li><a href="'.$url.'page='.($all).'">最后一页</a></li>';
	}
	?>
</ul>