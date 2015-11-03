<?php

/* 
 * file name : 
 *	Control.php
 * description :
 *	負責控制網址與POST的操作
 * start date :
 *	2015/10/19
 * author :
 *	Lanker
 */

session_start();

class Control {
    private $instr;

    public function __construct() {
	
	//時間初始設定, date() strtotime() 須要
	date_default_timezone_set('Asia/Taipei');

	if(isset($_POST['instr']))
	    $this->instr = $_POST['instr'];
    }

    public function execInstr() {
	try {
	    if(!isset($this->instr))
		throw new Exception("instr not defined");
	    $instr = $this->instr;
	    $instr();
	}
	catch(Exception $e) {
	    $reData = Array();
	    $reData['status'] = 500;
	    $reData['msg'] = $e->getMessage();
	    $reData['trace'] = $e->getTrace();
	    echo json_encode($reData);
	}
    }

}


function prodList() {
    require_once("prodAdm/Product.php");
    $nowPage = $_POST['nowPage'];
    $prodAdm = new Product();
    $prodList = $prodAdm->prodList($nowPage);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['data'] = $prodList;
    echo json_encode($reData);
}

function orderAdd() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->spanOrder($_POST);
}

function orderList() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->orderList();
}
