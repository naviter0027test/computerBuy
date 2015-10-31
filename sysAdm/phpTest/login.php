<html>
    <head>
	<title>login</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="login" />
	    帳號：<input type="text" name="account" /><br />
	    密碼：<input type="password" name="pass" /><br />
	    驗證碼：<img src="../../srvLib/Captcha.php" />
	    <button>登入</button>
	</form>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="isLogin" />
	    <button>是否登入</button>
	</form>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="logout" />
	    <button>登出</button>
	</form>
	<form action="../instr.php" method="post">
	    <h2>密碼修改</h2>
	    <input type="hidden" name="instr" value="passModify" />
	    密碼：<input type="password" name="pass" />
	    <button>修改</button>
	</form>
	<?php date_default_timezone_set('Asia/Taipei'); ?>
	<?php echo strtotime(date('Y-m-d')); ?>
    </body>
</html>
