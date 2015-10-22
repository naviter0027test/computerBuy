<html>
    <head>
	<title>add prod</title>
	<meta charset='utf-8' />
    </head>
    <body>
	<form action="../instr.php" method="post">
	    <input type='hidden' name="instr" value="addProduct" />
	    商品名：<input type="text" name="p_name" /><br />
	    商品價格：<input type="text" name="p_price" /><br />
	    商品描述：<textarea name="p_memo"></textarea><br />
	    <input type="hidden" name="p_cls" value="1"/><br />
	    <button>增加</button>
	</form>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="editProduct" />
	    商品編號：<input type="text" name="p_id" /><br />
	    商品名：<input type="text" name="p_name" /><br />
	    商品價格：<input type="text" name="p_price" /><br />
	    商品描述：<textarea name="p_memo"></textarea><br />
	    <input type="hidden" name="p_cls" value="1"/><br />
	    <button>編輯</button>
    </body>
</html>
