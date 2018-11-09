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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
function bs_input_file() {
$(".input-file").before(
	function() {
		if ( ! $(this).prev().hasClass('input-ghost') ) {
			var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
			element.attr("name",$(this).attr("name"));
			element.change(function(){
				element.next(element).find('input').val((element.val()).split('\\').pop());
			});
			$(this).find("button.btn-choose").click(function(){
				element.click();
			});
			$(this).find("button.btn-reset").click(function(){
				element.val(null);
				$(this).parents(".input-file").find('input').val('');
			});
			$(this).find('input').css("cursor","pointer");
			$(this).find('input').mousedown(function() {
				$(this).parents('.input-file').prev().click();
				return false;
			});
			return element;
		}
	}
);
}
$(function() {bs_input_file();});
</script>
</head>

<body>
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<h3>Select a Excel file for upload..</h3>
		<form method="POST" action="index.php" enctype="multipart/form-data">
		<div class="form-group">
			<div class="input-group input-file" name="filename">
			<span class="input-group-btn"><button class="btn btn-default btn-choose" type="button">Choose</button></span>
			<input type="text" class="form-control" placeholder='Choose a .xls file ' />	
			</div><br>
			<button type="submit" class="btn btn-primary pull-right">Submit</button>
		</div>
		</form>
	</div>
</div>
<br>
<div class="container">
<?php
if (!empty($data)){
	echo $data->dump(true,true);
}
?>
</div>
<br><br>
</body>
</html>
