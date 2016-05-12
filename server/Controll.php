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

            $logFile = fopen("log.txt", "a") or die("Unable to open file!");
            $txt = "[". date("Y-m-d H:i:s"). "]:". $_SERVER['SERVER_ADDR']. ":$instr\n";
            fwrite($logFile, $txt);
            fclose($logFile);

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

function prodList() {
    require_once("prodAdm/Product.php");
    //$nowPage = $_POST['nowPage'];
    $prodAdm = new Product();
    $prodList = $prodAdm->prodList($_POST);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['data'] = $prodList;
    return $reData;
}

function orderAdd($order = null) {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $mid = null;
    if(isset($_SESSION['mid']))
        $mid = $_SESSION['mid'];
    if($order == null)
	$orderAdm->spanOrder($_POST, $mid);
    else
	$orderAdm->spanOrder($order, $mid);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "order span success";
    return $reData;
}

function orderDetailAdd() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $orderAdm->detailAdd($_POST);
    $reData['status'] = 200;
    $reData['msg'] = "order detail add";
    return $reData;
}

function maxPage() {
    require_once("prodAdm/Product.php");
    $prodAdm = new Product();
    $cls = null;
    if(isset($_POST['cls']))
	$cls = $_POST['cls'];
    $amount = $prodAdm->productAmount($cls);
    $interval = $_POST['interval'];
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['pageSum'] = ceil($amount / $interval);
    return $reData;
}

function addRedMoney() {
    print_r($_POST);
}

function createOrder() {
    require_once("prodAdm/Product.php");
    require_once("orderAdm/Order.php");
    $prodAdm = new Product();
    $orderAdm = new Order();
    $order = $_POST;
    $order['o_no'] = "PSN". strtotime(date("Y-m-d H:i:s"));

    //計算總金額
    $total = 0;
    foreach($order['cart']['cart'] as $item) {
	$buyDetail = $prodAdm->getProd($item['p_id']);
	$total += $buyDetail['p_price'] * $item['amount'];
    }

    $order['total'] = $total;
    orderAdd($order);

    $orders = $orderAdm->getOrder($order['o_no']);
    $odr = $orders[0];

    $counter = 0;
    foreach($order['cart']['cart'] as $item) {
	$buyDetail = $prodAdm->getProd($item['p_id']);
	$buyDetail['o_no'] = $order['o_no'];
	$buyDetail['o_id'] = $odr['o_id'];
	$buyDetail['od_qty'] = $item['amount'];
	$buyDetail['od_price'] = $buyDetail['p_price'];
	$buyDetail['od_subtotal'] = $buyDetail['p_price'] * $item['amount'];
	$buyDetail['od_note'] = "";
	$orderAdm->detailAdd($buyDetail);
    }
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "order span success";
    $reData['order'] = $odr;
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

function getOrder() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $odr = $orderAdm->getOrder($_POST['orderSN'])[0];
    $details = $orderAdm->getDetails($_POST['orderSN']);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    $reData['order'] = $odr;
    $reData['details'] = $details;
    return $reData;
}

function shipList() {
    require_once("payModeAdm/PayMode.php");
    $payMode = new PayMode();
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "pay mode list show";
    $reData['data'] = $payMode->lists();
    return $reData;
}

function login() {
    require_once("memAdm/Member.php");
    $member = new Member();
    $user = $_POST['user'];
    if($_POST['pass'] == "")
        throw new Exception("please input password");
    $pass = md5($_POST['pass']);
    $mid = $member->login($user, $pass);

    $_SESSION['mid'] = $mid;

    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "login success";
    return $reData;
}

function isLogin() {
    $reData = Array();
    if(isset($_SESSION['mid'])) {
        $reData['status'] = 200;
        $reData['msg'] = "login already";
    }
    else {
        $reData['status'] = 500;
        $reData['msg'] = "not login";
    }
    return $reData;
}

function myOrders() {
    require_once("orderAdm/Order.php");
    $orderAdm = new Order();
    $reData = Array();
    if(isset($_SESSION['mid'])) {
        $reData['status'] = 200;
        $reData['msg'] = "get member list success";
        $reData['data'] = $orderAdm->getListByMember($_SESSION['mid']);
    }
    else {
        $reData['status'] = 500;
        $reData['msg'] = "not login";
    }
    return $reData;
}

function logout() {
    unset($_SESSION['mid']);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "logout success";
    return $reData;
}

?>
