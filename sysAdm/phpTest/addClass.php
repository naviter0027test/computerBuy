<html>
    <head>
	<title>class add </title>
	<meta charset="utf-8" />
    </head>
    <body>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="addClass" />
	    <label>分類名稱</label><input type="text" name="c_name" /><br />
	    <button>新增</button>
	</form>

	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="classList" />
	    <button>列表</button>
	</form>

	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="classEdit" />
	    c_id<input type="text" name="c_id" /><br />
	    c_name<input type="text" name="c_name" /><br />
	    <button>修改</button>
	</form>

	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="classDel" />
	    c_id<input type="text" name="c_id" /><br />
	    <button>刪除</button>
	</form>
    </body>
</html>
