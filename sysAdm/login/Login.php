<?php

/*
 *  File Name :
 *	Login.php
 *  Describe :
 *	登出、登入與檢查是否登入
 *  Start Date :
 *	2015.10.22
 *  Author :
 *	Lanker
 */

class Login {
    private $pid;
    private $mysql;

    public function __construct() {
	require_once("../srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

    public function login($loginData) {
	if(isset($_SESSION['sysLogin']) 
	    && $_SESSION['sysLogin'] == true)
	    throw new Exception("已經登入了");
	$dbAdm = $this->mysql;

	$tablename = "Sys";
	$columns = Array();
	$columns[0] = "*";
	$conditionArr = Array();
	$conditionArr['s_value'] = "'". $loginData['account']. "'";
	$dbAdm->selectData($tablename, $columns, $conditionArr);
	$dbAdm->execSQL();
	if(count($dbAdm->getAll()) == 1) {
	    $conditionArr['s_value'] = "md5('". $loginData['pass']. "')";
	    $dbAdm->selectData($tablename, $columns, $conditionArr);
	    $dbAdm->execSQL();
	    if(count($dbAdm->getAll()) == 1) 
		$_SESSION['sysLogin'] = true;
	    else
		throw new Exception("密碼錯誤");
	}
	else
	    throw new Exception("帳號錯誤");
    }

    public function logout() {
	if(isset($_SESSION['sysLogin']))
	    unset($_SESSION['sysLogin']);
	else
	    throw new Exception("已經登出");
    }

    public function isLogin() {
	if(isset($_SESSION['sysLogin']) 
	    && $_SESSION['sysLogin'] == true)
	    return true;
	return false;
    }
}

