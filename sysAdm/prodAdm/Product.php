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

	mkdir("../imgs/prod/$folderName");
	rename("imgs/tmp/". $computer['p_img'], "../imgs/prod/$folderName/". $computer['p_img']);
    }

    public function editProd($computer) {
	$dbAdm = $this->mysql;
	$folderName = $computer['p_folder'];
	if($computer['p_folder'] == "")
	    $folderName = strtotime(date('Y-m-d h:i:s'));

	$tablename = "Product";
	$columns = Array();
	$columns['p_name'] = "'". $computer['p_name']. "'";
	$columns['p_price'] = $computer['p_price'];
	$columns['p_memo'] = "'". $computer['p_memo']. "'";
	$columns['p_cls'] = $computer['p_cls'];
	$columns['p_img'] = "'". $computer['p_img']. "'";
	$columns['p_folder'] = "'". $folderName. "'";

	$conditionArr = Array();
	$conditionArr['p_id'] = $computer['p_id'];

	$dbAdm->updateData($tablename, $columns, $conditionArr);
	//echo $dbAdm->echoSQL();
	$dbAdm->execSQL();

	if(!file_exists("../imgs/prod/$folderName/"))
	    mkdir("../imgs/prod/$folderName/");
	rename("imgs/tmp/". $computer['p_img'], "../imgs/prod/$folderName/". $computer['p_img']);
    }

    public function getProd($prodId) {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns[0] = "*";

	$where = Array();
	$where['p_id'] = $prodId;
	$dbAdm->selectData($tablename, $columns, $where);
	$dbAdm->execSQL();

	return $dbAdm->getAll()[0];
    }

    public function prodList($nowPage = 1) {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns[0] = "*";

	$order = Array();
	$order['col'] = "p_crTime";
	$order['order'] = "desc";

	$limit = null;
	if($nowPage != null) {
	    $limit = Array();
	    $limit['offset'] = ($nowPage - 1) * 10;
	    $limit['amount'] = 10;
	}
	//$dbAdm->selectData($tablename, $columns, null, $order, $limit);
	$dbAdm->sqlSet("select p.*, c.c_name as clsName from Product p, Classification c where p.p_cls = c.c_id order by p.p_crTime desc limit ". $limit['offset']. ",". $limit['amount']. " ");
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

    public function productAmount() {
	$dbAdm = $this->mysql;
	$tablename = "Product";
	$columns = Array();
	$columns[0] = "count(*) as amount";

	$dbAdm->selectData($tablename, $columns);
	$dbAdm->execSQL();
	$amount = $dbAdm->getAll()[0]['amount'];
	return $amount;
    }
}
