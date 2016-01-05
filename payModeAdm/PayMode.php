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
	require_once("srvLib/MysqlCon.php");
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

    public function modifyOne($payData) {
        $dbAdm = $this->mysql;
        $tablename = "PayMode";
	$columns = Array();
	$columns['pm_name'] = "'". $payData['pm_name']. "'";
	$columns['pm_shipment'] = $payData['pm_shipment'];
	$columns['pm_threshold'] = $payData['pm_threshold'];

	$conditionArr = Array();
	$conditionArr['pm_id'] = $payData['pm_id'];
	$dbAdm->updateData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
    }
}

?>
