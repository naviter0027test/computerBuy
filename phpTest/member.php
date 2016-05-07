<html>
    <head>
        <title>會員測試</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <form action="../instr.php" method="post">
            <input type="hidden" name="instr" value="login" />
            user: <input type="text" name="user" /><br />
            pass: <input type="password" name="pass" /><br />
            <button>login</button>
        </form>

        <form action="../instr.php" method="post">
            <input type="hidden" name="instr" value="isLogin" />
            <button>check login</button>
        </form>

        <form action="../instr.php" method="post">
            <input type="hidden" name="instr" value="logout" />
            <button>logout</button>
        </form>
    </body>
</html>
