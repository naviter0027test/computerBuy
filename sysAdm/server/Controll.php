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
	$instr = $this->instr;
	try {
	    $instr();
	}
	catch(Exception $e) {
	    print_r($e);
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
