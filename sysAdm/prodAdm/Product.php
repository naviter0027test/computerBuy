<?php

/*
 *  File Name :
 *	Product.php
 *  Describe :
 *	商品的資料庫操作
 *  Start Date :
 *	2015.10.19
 *  Author :
 *	Lanker
 */

class Product {
    private $pid;
    private $mysql;

    public function __construct() {
	require_once("../srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

    public function addProd($computer) {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns[0] = "p_name";
	$columns[1] = "p_price";
	$columns[2] = "p_memo";
	$columns[3] = "p_cls";

	$data = Array();
	$data[0] = "'". $computer['p_name']. "'";
	$data[1] = $computer['p_price'];
	$data[2] = "'". $computer['p_memo']. "'";
	$data[3] = $computer['p_cls'];
	$dbAdm->insertData($tablename, $columns, $data);
	$dbAdm->execSQL();
    }

    public function editProd($computer) {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns['p_name'] = "'". $computer['p_name']. "'";
	$columns['p_price'] = "'". $computer['p_price']. "'";
	$columns['p_memo'] = "'". $computer['p_memo']. "'";
	$columns['p_cls'] = "'". $computer['p_cls']. "'";

	$conditionArr = Array();
	$conditionArr['p_id'] = $computer['p_id'];

	$dbAdm->updateData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
    }

    public function prodList() {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns[0] = "*";

	$dbAdm->selectData($tablename, $columns);
	$dbAdm->execSQL();
	return $dbAdm->getAll();
    }

    public function delProduct($pid) {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$conditionArr = Array();
	$conditionArr['p_id'] = $pid;

	$dbAdm->deleteData($tablename, $conditionArr);
	$dbAdm->execSQL();
    }
}
