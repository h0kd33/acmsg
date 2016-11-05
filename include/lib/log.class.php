<?php
/*
file log.class.php
记录信息到日志
*/

defined('ACC')||exit('ACC Denied');
class log {
	
	const LOGFILE = 'curr.log'; //代表日志文件名称

	//写
	public static function write($cont) {
		$cont .= "\r\n";
		$log = self::isBak();
		$fh = fopen($log, 'ab');
		fputs($fh, $cont);
		fclose($fh);
	}

	//备份
	public static function bak() {
		$log = ROOT . 'data/log/' . self::LOGFILE;
		$bak = ROOT . 'data/log/' . date('ymd') . mt_rand(10000,99999) . '.bak';
		return rename($log, $bak);
	}

	//判断日志大小
	public static function isBak() {
		$log = ROOT . 'data/log/' . self::LOGFILE;

		if (!file_exists($log)) {
			touch($log);
			return $log;
		}
		clearstatcache(true, $log);
		$filesize = filesize($log);
		if ($filesize <= 1024*1024) {
			return $log;
		}

		self::bak()&&touch($log);
		return $log;
	}


}
