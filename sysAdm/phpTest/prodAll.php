<html>
    <head>
	<title>show product all</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="prodList" />
	    <button>確定</button>
	</form>
	
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="oneProd" />
	    prod id:<input type="text" name="p_id" />
	    <button>確定</button>
	</form>
    </body>
</html>
