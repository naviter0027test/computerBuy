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
    </body>
</html>
