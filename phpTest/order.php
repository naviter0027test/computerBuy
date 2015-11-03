<html>
    <head>
	<title>order</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<form action="../instr.php" method="post">
	    <input type="hidden" name="instr" value="orderAdd" />
	    商品名稱:<input type="text" name="buyName" /><br />
	    商品價格:<input type="text" name="total" /><br />
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
    </body>
</html>


