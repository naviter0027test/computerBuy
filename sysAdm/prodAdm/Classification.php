<?php

/* 
 * file name : 
 *	Classification.php
 * description :
 *	針對商品項的分類管理
 * start date :
 *	2015/10/19
 * author :
 *	Lanker
 */

class Classification {
    private $mysql;

    public function __construct() {
	require_once("../srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

    public function addClass($cName) {
	$dbAdm = $this->mysql;
	$tablename = "Classification";
	$columns = Array();
	$columns[0] = "c_name";

	$data = Array();
	$data[0] = "'$cName'";
	$dbAdm->insertData($tablename, $columns, $data);
	$dbAdm->execSQL();
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

    public function classUpdate($cls) {
	$dbAdm = $this->mysql;
	$tablename = "Classification";
	$updData = Array();
	$updData['c_name'] = "'". $cls['c_name']. "'";

	$conditionArr = Array();
	$conditionArr['c_id'] = $cls['c_id'];
	$dbAdm->updateData($tablename, $updData, $conditionArr);
	$dbAdm->execSQL();
    }

    public function del($c_id) {
	$dbAdm = $this->mysql;
	$tablename = "Classification";

	$conditionArr = Array();
	$conditionArr['c_id'] = $c_id;
	$dbAdm->deleteData($tablename, $conditionArr);
	$dbAdm->execSQL();
    }
}

?>
