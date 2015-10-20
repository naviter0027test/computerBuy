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
    $prodAdm = new Classification();
    $prodAdm->addClass($_POST['c_name']);
    $reData = Array();
    $reData['status'] = 200;
    $reData['msg'] = "success";
    echo json_encode($reData);
}
