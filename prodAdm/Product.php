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
	require_once("srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

    public function addProd($computer) {
	$dbAdm = $this->mysql;
	$folderName = strtotime(date('Y-m-d h:i:s'));

	$tablename = "Product";
	$columns = Array();
	$columns[0] = "p_name";
	$columns[1] = "p_price";
	$columns[2] = "p_memo";
	$columns[3] = "p_cls";
	$columns[4] = "p_img";
	$columns[5] = "p_folder";

	$data = Array();
	$data[0] = "'". $computer['p_name']. "'";
	$data[1] = $computer['p_price'];
	$data[2] = "'". $computer['p_memo']. "'";
	$data[3] = $computer['p_cls'];
	$data[4] = "'". $computer['p_img']. "'";
	$data[5] = "'$folderName'";
	$dbAdm->insertData($tablename, $columns, $data);
	$dbAdm->execSQL();

	mkdir("../imgs/$folderName");
	rename("imgs/tmp/". $computer['p_img'], "../imgs/$folderName/". $computer['p_img']);
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

    public function prodList($listPara) {
	if(isset($listPara['nowPage']))
	    $nowPage = $listPara['nowPage'];
	else
	    $nowPage = null;
	if(isset($listPara['cls']))
	    $cls = $listPara['cls'];
	else
	    $cls = null;
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns[0] = "*";

	$conditionArr = Array();
	$conditionArr['active'] = "'Y'";
	if(isset($cls)) {
	    $conditionArr['p_cls'] = $cls;
	}

	$order = Array();
	$order['col'] = "p_crTime";
	$order['order'] = "desc";

	$limit = null;
	if($nowPage != null) {
	    $limit = Array();
	    $limit['offset'] = ($nowPage - 1) * 10;
	    $limit['amount'] = 9;
	}
	$dbAdm->selectData($tablename, $columns, $conditionArr, $order, $limit);
	$dbAdm->execSQL();
	return $dbAdm->getAll();
    }

    public function getProd($p_id) {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns[0] = "*";

	$conditionArr = Array();
	$conditionArr['p_id'] = $p_id;
	$dbAdm->selectData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
	$products = $dbAdm->getAll();
	if(!isset($products[0]))
	    return null;
	return $products[0];
    }

    public function productAmount($cls = null) {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns[0] = "count(*) as amount";

	$conditionArr = null;
	if($cls != null) {
	    $conditionArr = Array();
	    $conditionArr['p_cls'] = $cls;
	}

	$dbAdm->selectData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
	$amount = $dbAdm->getAll()[0]['amount'];
	return $amount;
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
