<html>
    <head>
	<title>upload test</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<form action="../instr.php" method="post" enctype='multipart/form-data'>
	    <input type="hidden" name="instr" value="upload" />
	    <input type="file" name="file[]" />
	    <input type="file" name="file[]" />
	    <button>上傳</button>
	</form>
    </body>
</html>
