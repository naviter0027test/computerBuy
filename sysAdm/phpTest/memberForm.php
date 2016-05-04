<!--
File Name :
    memberForm.php
Describe :
    send instr to test
    add, edit, list and delete
Author :
    Lanker
Start Date :
    2016.05.04
-->

<form action="../instr.php" method="post">
    <input type="hidden" name="instr" value="test" />
    <button>測試</button>
</form>

<form action="../instr.php" method="post">
    <input type="hidden" name="instr" value="memList" />
    頁數:<input type="text" name="nowPage" /><br />
    <button>列表</button>
</form>

<form action="../instr.php" method="post">
    <input type="hidden" name="instr" value="memAdd" />
    帳號(email):<input type="text" name="account" /><br />
    密碼:<input type="password" name="pass" /><br />
    姓名:<input type="text" name="name" /><br />
    手機:<input type="text" name="phone" /><br />
    電話:<input type="text" name="tel" /><br />
    城市:<input type="text" name="city" /><br />
    地區:<input type="text" name="area" /><br />
    地址:<input type="text" name="addr" /><br />
    生日:<input type="text" name="birthday" /><br />
    <button>會員新增</button>
</form>

<form action="../instr.php" method="post">
    <input type="hidden" name="instr" value="memUpd" />
    會員編號<input type="text" name="m_id" /><br />
    密碼:<input type="password" name="pass" /><br />
    姓名:<input type="text" name="name" /><br />
    手機:<input type="text" name="phone" /><br />
    電話:<input type="text" name="tel" /><br />
    城市:<input type="text" name="city" /><br />
    地區:<input type="text" name="area" /><br />
    地址:<input type="text" name="addr" /><br />
    生日:<input type="text" name="birthday" /><br />
    <button>會員修改</button>
</form>

<form action="../instr.php" method="post">
    <input type="hidden" name="instr" value="memDel" />
    會員編號<input type="text" name="m_id" /><br />
    <button>會員刪除</button>
</form>

<form action="../instr.php" method="post">
    <input type="hidden" name="instr" value="memOne" />
    會員編號<input type="text" name="m_id" /><br />
    <button>會員查詢</button>
</form>
