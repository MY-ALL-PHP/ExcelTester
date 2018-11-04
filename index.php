<?php
error_reporting(E_ALL ^ E_NOTICE);
if ($_FILES){
	$name = $_FILES['filename']['name'];
	move_uploaded_file($_FILES['filename']['tmp_name'], $name);
	require_once 'excel_reader.php';
	$data = new Spreadsheet_Excel_Reader("$name");
}
?>

<html>
<head>
<style>
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
</style>
</head>

<body>
	<form method='post' action='index.php' enctype='multipart/form-data'>
	Select File: <input type='file' name='filename' size='10' />
	<input type='submit' value='Upload' />
	</form>

	<?php
	if (!empty($data)){
		echo $data->dump(true,true);
	}
	?>
</body>
</html>
