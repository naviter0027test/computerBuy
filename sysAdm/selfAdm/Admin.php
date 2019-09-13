<?php

/* 
 * file name : 
 *	Admin.php
 * description :
 *	管理者自身操作
 * start date :
 *	2019/09/13
 * author :
 *	Lanker
 */

class Admin {
    private $mysql;

    public function __construct() {
	require_once("../srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

    public function passChange($pass) {
	$dbAdm = $this->mysql;
	$tablename = "Sys";
	$updData = Array();
	$updData['s_value'] = "'". md5($pass). "'";

	$conditionArr = Array();
	$conditionArr['s_key'] = "'pass'";
	$dbAdm->updateData($tablename, $updData, $conditionArr);
	$dbAdm->execSQL();
    }
}
