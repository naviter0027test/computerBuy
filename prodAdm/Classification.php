<?php

/* 
 * file name : 
 *	Classification.php
 * description :
 *	針對商品項的分類顯示
 * start date :
 *	2015/11/24
 * author :
 *	Lanker
 */

class Classification {
    private $mysql;

    public function __construct() {
	require_once("srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

    public function classList() {
	$dbAdm = $this->mysql;
	$tablename = "Classification";
	$columns = Array();
	$columns[0] = "*";

	$dbAdm->selectData($tablename, $columns);
	$dbAdm->execSQL();
	return $dbAdm->getAll();
    }
}
