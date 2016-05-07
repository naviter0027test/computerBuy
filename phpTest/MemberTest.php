<meta charset="utf-8" />
<?php
/*
 *  File Name :
 *	MemberTest.php
 *  Describe :
 *      測試以下功能
 *	會員登入 、會員修改 、會員註冊
 *  Version : 
 *	1.0
 *  Start Date :
 *	2015.09.24
 *  Author :
 *	Lanker
 */
require_once("../srvLib/simpletest/autorun.php");

class MemberTest extends UnitTestCase {
    function testInit() {
        require_once("../memAdm/Member.php");
        $this->assertEqual(true, true);
    }

    function testLogin() {
        require_once("../memAdm/Member.php");
        $member = new Member();
        $user = "test2@test.com.tw";
        $pass = md5("123456");
        try {
            $mid = $member->login($user, $pass);
            $this->assertNotEqual($mid, 0);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            $this->assertTrue(false);
        }
    }
}
