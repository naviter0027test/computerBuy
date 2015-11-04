<html>
    <head>
	<title>order</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="orderAdd" />
	    商品名稱:<input type="text" name="buyName" /><br />
	    商品小計:<input type="text" name="total" /><br />
	    電子郵件:<input type="text" name="buyEmail" /><br />
	    聯絡電話:<input type="text" name="buyTel" /><br />
	    地址:
	    <select name="buyCity" />
		<option value="台北市">台北市</option>
		<option value="台中市">台中市</option>
		<option value="台南市">台南市</option>
	    </select>
	    <select name="buyArea" />
		<option value="測試區">測試區</option>
		<option value="北平區">北平區</option>
		<option value="輛長驅">輛長驅</option>
	    </select>
	    <input type="text" name="buyAddr" /><br />
	    付款方式:
	    <input type="radio" name="payMode" value="atm" />atm <br />
	    <input type="hidden" name="shipMode" value="大榮貨運"/>
	    發票:
	    <input type="radio" name="invoice_type" value="1" />個人
	    <input type="radio" name="invoice_type" value="2" />公司<br />
	    atm後五碼:<input type="text" name="atm_act5" />
	    <button>確定</button>
	</form>
	<br />
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="orderList" />
	    <button>清單</button>
	</form>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="orderDel" />
	    訂單編號<input type="text" name="o_id" />
	    <button>刪除</button>
	</form>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="orderActive" />
	    訂單編號<input type="text" name="o_id" /><br />
	    <select name="active">
		<option value="未處理">未處理</option>
		<option value="處理中">處理中</option>
		<option value="已付款">已付款</option>
		<option value="已出貨">已出貨</option>
		<option value="訂單取消">訂單取消</option>
	    </select>
	    <button>修改</button>
	</form>
    </body>
</html>


