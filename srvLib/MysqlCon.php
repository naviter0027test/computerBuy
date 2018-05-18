<?php

/*
 *  File Name :
 *	MysqlCon.php
 *  Describe :
 *	Mysql library implement by pdo 
 *  Version : 
 *	1.0
 *  Start Date :
 *	2015.09.24
 *  Author :
 *	Lanker
 */

class MysqlCon {
    protected $con;
    protected $sql;
    protected $res;

    public function __construct($webSite = "localhost", $user = "combuy", $passwd = "nv2kau3", $db = "ComputerBuy") {
	$dbconStat = "mysql:host=$webSite;dbname=$db";
	$this->con = new PDO($dbconStat, $user, $passwd);
    }

    public function sqlSet($sql) {
	$this->sql = $sql;
    }

    public function echoSQL() {
	return $this->sql;
    }

    public function insertData($tableName, $columns, $data) {
	$sql = "insert into $tableName ( ";
	foreach($columns as $col)
	    $sql .= $col. ', ';
	$sql = substr($sql, 0, strrpos($sql, ',', -1));
	$sql .= ") values(";
	foreach($data as $col)
	    $sql .= $col. ', ';
	$sql = substr($sql, 0, strrpos($sql, ',', -1));
	$sql .= ")";
	//echo $sql;

	$this->sql = $sql;
    }

    public function execSQL() {
	$res = $this->con->query($this->sql);
	$this->res = $res;
	if($res)
	    return $res;
	else
	    throw new Exception("mysqlError:". $this->errorMsg());
    }

    public function getAll() {
	return $this->res->fetchAll();
    }

    public function errorMsg() {
	return $this->con->errorInfo()[2];
    }

    public function deleteData($tableName, $conditionArr) {
	$sql = "delete from $tableName where ";
	foreach($conditionArr as $col => $data)
	    $sql .= "$col = $data && ";
	$sql = substr($sql, 0, strrpos($sql, '&&', -1));
	$this->sql = $sql;

    }

    public function selectData($tableName, $columns, $conditionArr = null, $orderBy = null, $limit = null) {
	$sql = "select ";
	foreach($columns as $col) {
	    $sql .= $col. ', ';
	}
	$sql = substr($sql, 0, strrpos($sql, ',', -1));
	$sql .= " from $tableName ";

	if($conditionArr != null) {
	    $sql .= "where ";
	    foreach($conditionArr as $col => $data)
		$sql .= "$col = $data && ";
	    $sql = substr($sql, 0, strrpos($sql, '&&', -1));
	}

	if($orderBy != null)
	    $sql .= " order by ". $orderBy['col']. " ". $orderBy['order']. " ";
	if($limit != null)
	    $sql .= " limit ". $limit['offset']. ",". $limit['amount']. " ";

	$this->sql = $sql;
	//echo $sql;
    }

    public function updateData($tableName, $colDatas, $conditionArr) {
	$sql = "update $tableName set ";

	foreach($colDatas as $col => $data) 
	    $sql .= "$col = $data, ";
	$sql = substr($sql, 0, strrpos($sql, ',', -1));

	$sql .= " where ";
	foreach($conditionArr as $col => $data)
	    $sql .= "$col = $data && ";
	$sql = substr($sql, 0, strrpos($sql, '&&', -1));

	$this->sql = $sql;
    }

    public function __destruct() {
	$this->con = NULL;
    }
}

?>

