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

	if(isset($_GET['instr']))
	    $this->instr = $_GET['instr'];

	if(isset($_POST['instr']))
	    $this->instr = $_POST['instr'];
    }

    public function execInstr() {
	try {
	    if(!isset($this->instr))
		throw new Exception("instr not defined");
	    $instr = $this->instr;
	    $reData = $instr();
	    echo json_encode($reData);
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
    return $reData;
}

function editProduct() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $prodAdm->editProd($_POST);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    return $reData;
}

function prodList() {
    require_once("prodAdm/Product.php");
    $interval = $_POST['interval'];
    $prodAdm = new Product();
    $prodList = $prodAdm->prodList($_POST['nowPage']);
    $amount = $prodAdm->productAmount();
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['data'] = $prodList;
    $reData['pageSum'] = ceil($amount / $interval);
    return $reData;
}

function oneProd() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $prodId = $_POST['p_id'];
    $product = $prodAdm->getProd($prodId);

    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['data'] = $product;
    return $reData;
}

function delProduct() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $prodAdm->delProduct($_POST['p_id']);

    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    return $reData;
}

function prodAct() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $prodAdm->updateAct($_POST);

    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    return $reData;
}

function addClass() {
    require_once("prodAdm/Classification.php");
    $classAdm = new Classification();
    $classAdm->addClass($_POST['c_name']);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    return $reData;
}

function classList() {
    require_once("prodAdm/Classification.php");
    $classAdm = new Classification();
    $classList = $classAdm->classList();
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['data'] = $classList;
    return $reData;
}

function classEdit() {
    require_once("prodAdm/Classification.php");
    $classAdm = new Classification();
    $classAdm->classUpdate($_POST);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    return $reData;
}

function classDel() {
    require_once("prodAdm/Classification.php");
    $classAdm = new Classification();
    $classAdm->del($_POST['c_id']);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    return $reData;
}

function login() {
    require_once("login/Login.php");
    $captcha = $_SESSION['login']['captcha'];
    if($captcha != $_POST['captcha'])
	throw new Exception("驗證碼錯誤");
    $loginAdm = new Login();
    $loginAdm->login($_POST);
    $reData['status'] = 200;
    $reData['msg'] = "success";
    return $reData;
}

function captchaShow() {
    require_once("../srvLib/Captcha.php");
    switch($_GET['cls']) {
    case "login" :
	$_SESSION['login']['captcha'] = rand(1000, 9999);
	break;
    }
    $captcha = new Captcha($_SESSION['login']['captcha']);
}

function logout() {
    require_once("login/Login.php");
    $loginAdm = new Login();
    $loginAdm->logout();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    return $reData;
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
    return $reData;
}

function passModify() {
    require_once("login/Login.php");
    $loginAdm = new Login();
    $loginAdm->modifyPass($_POST['pass']);
    $reData['status'] = 200;
    $reData['msg'] = "修改成功";
    return $reData;
}

function orderAdd() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->spanOrder($_POST);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "order span success";
    return $reData;
}

function orderPage($page) {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    return $orderAdm->orderAmount();
}

function oneOrder() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    return $orderAdm->oneOrder($_POST);
}

function orderList() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orders = $orderAdm->orderList($_POST);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "order list success";
    $reData['orders'] = $orders;
    $reData['orderAmount'] = orderPage($_POST);
    return $reData;
}

function orderDel() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->cancelOrder($_POST['o_id']);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "order cancel success";
    return $reData;
}

function orderActive() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->updActive($_POST);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "active modify success";
    return $reData;
}

function odrDetailList() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $nowPage = $_POST['nowPage'];
    print_r($orderAdm->detailList($nowPage));
}
