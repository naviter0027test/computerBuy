<?php 
/*
 *  File Name :
 *      PayMode.php
 *  Describe : 
 *      取出所有付款模式，並能修改與刪除
 *  Author :
 *      Lanker
 *  Start Date :
 *      2015.12.25
 */

class PayMode {
    private $mysql;

    public function __construct() {
	require_once("../srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

    public function lists() {
        $dbAdm = $this->mysql;
        $tablename = "PayMode";
	$columns = Array();
	$columns[0] = "*";

        $dbAdm->selectData($tablename, $columns);
	$dbAdm->execSQL();
	return $dbAdm->getAll();
    }
}

?>
