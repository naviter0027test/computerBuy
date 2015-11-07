<html>
    <head>
	<title>show product all</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="prodList" />
	    頁數<input type="text" name="nowPage" />
	    <button>確定</button>
	</form>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="maxPage" />
	    一頁幾個<input type="text" name="interval" />
	    <button>頁數查看</button>
	</form>
    </body>
</html>

