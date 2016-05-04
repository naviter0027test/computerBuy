<meta charset="utf-8" />
<?php
/*
 *  File Name :
 *	MemberTest.php
 *  Describe :
 *      測試以下功能
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
require_once("../../srvLib/simpletest/autorun.php");

class MemberTest extends UnitTestCase {
    function testList() {
        require_once("../memAdm/Member.php");
        $memAdm = new Member();
        $limit = Array();
        $limit['offset'] = 0;
        $limit['amount'] = 10;
        $memList = $memAdm->memList($limit);
        $this->assertEqual($memList[0]['m_id'], 1);
        $this->assertEqual($memList[1]['m_id'], 2);
    }

    function testAdd() {
        $nameArr = Array("中豪", "偽名", "善得", "不予", "先盤", "硬名");

        $lastNameArr = Array("陳", "黃", "許", "賴", "東");

        $city = Array("台北市", "新北市", "桃園市", "新竹縣", "苗栗縣", "南投線", "彰化縣", "台中市", "嘉義市");

        $area = Array("甲地區", "乙地區", "丙地區", "丁地區", "戊地區", "己地區", "庚地區", "辛地區");

        $lastLen = count($lastNameArr);
        $nameLen = count($nameArr);
        $name = $lastNameArr[rand(0,$lastLen-1)]. $nameArr[rand(0, $nameLen-1)];
        echo $name. "<br />";
        $cityLen = count($city);
        $areaLen = count($area);
        $cityName = $city[rand(0, $cityLen-1)];
        $areaName = $area[rand(0, $areaLen-1)];
        $addr = "測試地區";
        echo $cityName. $areaName. $addr. "<br />";

        $email = "test". rand(10000, 99999). "@test.com.tw";
        echo $email. "<br />";

        require_once("../memAdm/Member.php");
        $memAdm = new Member();
        $memBlob = Array();
        $memBlob['m_account'] = $email;
        $memBlob['m_pass'] = md5('123456');
        $memBlob['m_name'] = $name;
        $memBlob['m_phone'] = "0123456789";
        $memBlob['m_tel'] = "01234567";
        $memBlob['m_city'] = $cityName;
        $memBlob['m_area'] = $areaName;
        $memBlob['m_addr'] = $addr;
        $memBlob['m_level'] = 1;
        $memBlob['m_birthday'] = "0000-00-00";
        $memBlob['m_active'] = "Y";
        $memBlob['m_crTime'] = date("Y-m-d H:i:s");
        $memAdm->memAdd($memBlob);
    }

    public function testOneGet() {
        require_once("../memAdm/Member.php");
        $memAdm = new Member();
        $m_id = 1;
        $oneData = $memAdm->getOne($m_id);
        $this->assertEqual($oneData['m_id'], 1);
        $this->assertEqual($oneData['m_name'], "jason");
    }

    public function testEdit() {
        require_once("../memAdm/Member.php");
        $memAdm = new Member();
        $m_id = 3;

        $memBlob = Array();
        $memBlob['m_name'] = "english";
        $memBlob['m_phone'] = "9876543210";
        $memBlob['m_tel'] = "76543210";
        $memAdm->memUpd($m_id, $memBlob);

        $oneData = $memAdm->getOne($m_id);
        $this->assertEqual($oneData['m_id'], 3);
        $this->assertEqual($oneData['m_name'], "english");
        $this->assertEqual($oneData['m_phone'], "9876543210");
    }

    public function testDel() {
        require_once("../memAdm/Member.php");
        $memAdm = new Member();
        $limit = Array();
        $limit['offset'] = 5;
        $limit['amount'] = 10;
        $memList = $memAdm->memList($limit);
        $delMem = $memList[rand(0, 9)];
        $memAdm->memDel($delMem['m_id']);
    }

    public function testMemberAmount() {
        require_once("../memAdm/Member.php");
        $memAdm = new Member();
        $this->assertTrue($memAdm->memAmount() > 20);
    }
}
?>
