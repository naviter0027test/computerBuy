<?php
/*
 *  File Name :
 *	Member.php
 *  Describe :
 *	會員登入 、會員修改 、會員註冊
 *  Version : 
 *	1.0
 *  Start Date :
 *	2015.09.24
 *  Author :
 *	Lanker
 */

class Member {
    private $dbAdm;
    private $table;

    public function __construct() {
        if(file_exists("../srvLib/MysqlCon.php")) 
            require_once("../srvLib/MysqlCon.php");
        else
            require_once("srvLib/MysqlCon.php");
        $this->dbAdm = new MysqlCon();
        $this->table = "Member";
    }

    public function login($user, $pass) {
        $dbAdm = $this->dbAdm;
        $table = $this->table;
        $columns = Array();
        $columns[0] = "*";

        $conditionArr = Array();
        $conditionArr['m_account'] = "'$user'";
        $conditionArr['m_pass'] = "'$pass'";
        $dbAdm->selectData($table, $columns, $conditionArr);
        $dbAdm->execSQL();
        $mem = $dbAdm->getAll()[0];
        if(!isset($mem['m_id'])) {
            throw new Exception("Exception: not find member");
        }
        return $mem['m_id'];
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
}
