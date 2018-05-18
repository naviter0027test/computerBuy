<?php

/*
 *  File Name :
 *	Order.php
 *  Describe :
 *	訂單資料操作
 *  Start Date :
 *	2015.11.03
 *  Author :
 *	Lanker
 */

class Order {
    private $mysql;

    public function __construct() {
	require_once("srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

    public function spanOrder($order, $mid) {
	$dbAdm = $this->mysql;
	$no = $order['o_no'];

	$tablename = "OrderList";
	$columns = Array();
	$columns[0] = "o_no";
	$columns[1] = "o_total";
	$columns[2] = "buyName";
	$columns[3] = "buyEmail";
	$columns[4] = "buyTel";
	$columns[5] = "buyCity";
	$columns[6] = "buyArea";
	$columns[7] = "buyAddr";
	$columns[8] = "payMode";
	$columns[9] = "shipMode";
	$columns[10] = "invoice_type";
	$columns[11] = "active";
        $columns[12] = "o_crTime";
	switch($order['payMode']) {
	case "atm" :
	    $columns[13] = "atm_act5";
	    break;
        case "card" :
            break;
        case "ezship" :
            break;
	default : 
	    throw new Exception("沒有指定付款方式");
	}
        $columns[] = "o_mid";

	$data = Array();
	$data[0] = "'$no'";
	$data[1] = $order['total'];
	$data[2] = "'". $order['buyName']. "'";
	$data[3] = "'". $order['buyEmail']. "'";
	$data[4] = "'". $order['buyTel']. "'";
	$data[5] = "'". $order['buyCity']. "'";
	$data[6] = "'". $order['buyArea']. "'";
	$data[7] = "'". $order['buyAddr']. "'";
	$data[8] = "'". $order['payMode']. "'";
        $data[9] = "'". /*$order['shipMode']*/"shipmode". "'";
	$data[10] = "'". $order['invoice_type']. "'";
	$data[11] = "'未處理'";
        $data[12] = "'". date("Y-m-d H:i:s"). "'";
	switch($order['payMode']) {
	case "atm" :
            $data[13] = "'". $order['atm_act5']. "'";
        break;
        case "card" :
            break;
        case "ezship" :
            break;
	default : 
	    throw new Exception("沒有指定付款方式");
	}

        foreach($columns as $idx => $column) 
            if($column == "o_mid") 
                if($mid == null)
                    $data[$idx] = 0;
                else
                    $data[$idx] = $mid;

	$dbAdm->insertData($tablename, $columns, $data);
	$dbAdm->execSQL();
    }

    public function cancelOrder($o_id) {
	$dbAdm = $this->mysql;

	$tablename = "OrderList";
	$columns = Array();
	$columns['active'] = "'訂單取消'";

	$conditionArr = Array();
	$conditionArr['o_id'] = $o_id;
	$dbAdm->updateData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
    }

    public function detailAdd($detail) {
	$dbAdm = $this->mysql;

	$tablename = "OrderDetail";
	$columns = Array();
	$columns[0] = 'o_id';
	$columns[1] = 'o_no';
	$columns[2] = 'p_id';
	$columns[3] = 'p_name';
	$columns[4] = 'od_qty';
	$columns[5] = 'od_price';
	$columns[6] = 'od_subtotal';
	$columns[7] = 'od_note';

	$data = Array();
	$data[0] = $detail['o_id'];
	$data[1] = "'". $detail['o_no']. "'";
	$data[2] = $detail['p_id'];
	$data[3] = "'". $detail['p_name']. "'";
	$data[4] = $detail['od_qty'];
	$data[5] = $detail['od_price'];
	$data[6] = $detail['od_subtotal'];
	$data[7] = "'". $detail['od_note']. "'";

	$dbAdm->insertData($tablename, $columns, $data);
	$dbAdm->execSQL();
    }

    public function getOrder($sn) {
	$dbAdm = $this->mysql;

	$tablename = "OrderList";
	$columns = Array();
	$columns[0] = "*";

	$conditionArr = Array();
	$conditionArr['o_no'] = "'". $sn. "'";

	$dbAdm->selectData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
	return $dbAdm->getAll();
    }

    public function getDetails($sn) {
        $dbAdm = $this->mysql;

        $tablename = "OrderDetail";
        $columns = Array();
        $columns[0] = "*";

        $conditionArr = Array();
	$conditionArr['o_no'] = "'". $sn. "'";
	$dbAdm->selectData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
	return $dbAdm->getAll();
    }

    public function getListByMember($mid) {
        $dbAdm = $this->mysql;

        $tablename = "OrderList";
        $columns = Array();
        $columns[0] = "*";

        $conditionArr = Array();
	$conditionArr['o_mid'] = $mid;

        $orderBy = Array();
        $orderBy['col'] = "o_crTime";
        $orderBy['order'] = "desc";
	$dbAdm->selectData($tablename, $columns, $conditionArr, $orderBy);
	$dbAdm->execSQL();
	return $dbAdm->getAll();
    }

    public function updOrder($ono, $updData) {
        $dbAdm = $this->mysql;

        $tablename = "OrderList";
	$columns = Array();
	$columns['ezshipInfo'] = "'". $updData['ezshipInfo']. "'";

	$conditionArr = Array();
	$conditionArr['o_no'] = "'". $ono. "'";

	$dbAdm->updateData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
    }
}
