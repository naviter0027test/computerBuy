<?php
/*
 *  File Name :
 *	Member.php
 *  Describe :
 *	會員列表
 *	會員修正
 *	會員註冊
 *	會員刪除
 *  Version : 
 *	1.0
 *  Start Date :
 *	2015.09.24
 *  Author :
 *	Lanker
 */

class Member {
    private $dbAdm;

    public function __construct() {
        if(file_exists("../../srvLib/MysqlCon.php")) 
            require_once("../../srvLib/MysqlCon.php");
        else
            require_once("../srvLib/MysqlCon.php");
        $this->dbAdm = new MysqlCon();
    }

    public function memList($limit) {
        $dbAdm = $this->dbAdm;
        $table = "Member";
        $columns = Array();
        $columns[0] = "*";
        $dbAdm->selectData($table, $columns, null, null, $limit);
        $dbAdm->execSQL();
        return $dbAdm->getAll();
    }

    public function memAdd($memBlob) {
        $dbAdm = $this->dbAdm;
        $table = "Member";
        $columns = Array();
        $insData = Array();
        $idx = 0;
        foreach($memBlob as $column => $value) {
            $columns[$idx] = $column;
            if(is_string($value))
                $insData[$idx] = "'$value'";
            else
                $insData[$idx] = $value;
            ++$idx;
        }
        //print_r($columns);
        //print_r($insData);
        $dbAdm->insertData($table, $columns, $insData);
        $dbAdm->execSQL();
    }

    public function getOne($m_id) {
        $dbAdm = $this->dbAdm;
        $table = "Member";
        $columns = Array();
        $columns[0] = "*";
        $conditionArr = Array();
        $conditionArr['m_id'] = $m_id;

        $dbAdm->selectData($table, $columns, $conditionArr);
        $dbAdm->execSQL();
        return $dbAdm->getAll()[0];
    }

    public function memUpd($m_id, $memBlob) {
        $dbAdm = $this->dbAdm;
        $table = "Member";
        $conditionArr = Array();
        $conditionArr['m_id'] = $m_id;

        foreach($memBlob as $col => $val) {
            if(is_string($val)) 
                $memBlob[$col] = "'$val'";
        }
        $dbAdm->updateData($table, $memBlob, $conditionArr);
        $dbAdm->execSQL();
    }

    public function memDel($m_id) {
        $dbAdm = $this->dbAdm;
        $table = "Member";
        $conditionArr = Array();
        $conditionArr['m_id'] = $m_id;

        $dbAdm->deleteData($table, $conditionArr);
        $dbAdm->execSQL();
    }

    public function memAmount() {
        $dbAdm = $this->dbAdm;
        $table = "Member";
        $columns = Array();
        $columns[0] = "*";
        $dbAdm->selectData($table, $columns);
        $dbAdm->execSQL();
        return count($dbAdm->getAll());
    }
}

?>
