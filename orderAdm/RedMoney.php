
<?php

/*
 *  File Name :
 *	RedMoney.php
 *  Describe :
 *	紅利金操作
 *  Start Date :
 *	2015.11.20
 *  Author :
 *	Lanker
 */

class RedMoney {
    private $mysql;

    public function __construct() {
	require_once("../srvLib/MysqlCon.php");
	$this->mysql = new MysqlCon();
    }

}

?>
