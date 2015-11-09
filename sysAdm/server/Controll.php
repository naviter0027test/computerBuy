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

function addProduct() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $prodAdm->addProd($_POST);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}

function editProduct() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $prodAdm->editProd($_POST);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}

function prodList() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $prodList = $prodAdm->prodList();
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['data'] = $prodList;
    echo json_encode($reData);
}

function delProduct() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $prodAdm->delProduct($_POST['p_id']);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}

function addClass() {
    require_once("prodAdm/Classification.php");
    $classAdm = new Classification();
    $classAdm->addClass($_POST['c_name']);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}

function classList() {
    require_once("prodAdm/Classification.php");
    $classAdm = new Classification();
    $classList = $classAdm->classList();
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['data'] = $classList;
    echo json_encode($reData);
}

function classEdit() {
    require_once("prodAdm/Classification.php");
    $classAdm = new Classification();
    $classAdm->classUpdate($_POST);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}

function classDel() {
    require_once("prodAdm/Classification.php");
    $classAdm = new Classification();
    $classAdm->del($_POST['c_id']);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}

function login() {
    require_once("login/Login.php");
    $loginAdm = new Login();
    $loginAdm->login($_POST);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}

function logout() {
    require_once("login/Login.php");
    $loginAdm = new Login();
    $loginAdm->logout();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}

function isLogin() {
    require_once("login/Login.php");
    $loginAdm = new Login();
    if($loginAdm->isLogin()) {
	$reData['status'] = 200;
	$reData['msg'] = "已經登入";
    }
    else {
	$reData['status'] = 500;
	$reData['msg'] = "尚未登入";
	$reData['jumpPage'] = "login.html";
    }
    echo json_encode($reData);
    exit;
}

function upload() {
    require_once("upload/Upload.php");
    $upfile = new Upload();
    $upResult = $upfile->uploadFinish();
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "上傳成功";
    $reData['info'] = $upResult;
    echo json_encode($reData);
}

function passModify() {
    require_once("login/Login.php");
    $loginAdm = new Login();
    $loginAdm->modifyPass($_POST['pass']);
    $reData['status'] = 200;
    $reData['msg'] = "修改成功";
    echo json_encode($reData);
}

function orderAdd() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->spanOrder($_POST);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "order span success";
    echo json_encode($reData);
}

function orderList() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orders = $orderAdm->orderList();
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "order cancel success";
    $reData['orders'] = $orders;
    echo json_encode($reData);
}

function orderDel() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->cancelOrder($_POST['o_id']);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "order cancel success";
    echo json_encode($reData);
}

function orderActive() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->updActive($_POST);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "active modify success";
    echo json_encode($reData);
}

function odrDetailList() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $nowPage = $_POST['nowPage'];
    print_r($orderAdm->detailList($nowPage));
}
