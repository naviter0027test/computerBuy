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

    public function spanOrder($order) {
	$dbAdm = $this->mysql;
	print_r($order);
	$no = "PSN". strtotime(date('Y-m-d h:i:s'));

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
	switch($order['payMode']) {
	case "atm" :
	    $columns[11] = "atm_act5";
	    break;
	default : 
	    throw new Exception("沒有指定付款方式");
	}

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
	$data[9] = "'". $order['shipMode']. "'";
	$data[10] = "'". $order['invoice_type']. "'";
	$data[11] = "'". $order['atm_act5']. "'";
	$dbAdm->insertData($tablename, $columns, $data);
	$dbAdm->execSQL();
    }

    public function orderList() {
	$dbAdm = $this->mysql;

	$tablename = "OrderList";
	$columns = Array();
	$columns[0] = "*";

	$dbAdm->selectData($tablename, $columns);
	$dbAdm->execSQL();
	print_r($dbAdm->getAll());
    }
}
