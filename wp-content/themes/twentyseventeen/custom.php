<?php
//Template Name:Custom_Template
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post">
<input type="text" name="name">
<input type="submit" name="submit" value="pdf" />
</form>
</body>
</html>
<?php
if(isset($_REQUEST['submit']))
{
	include("MPDF57/mpdf.php");
	$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;
	$mpdf->WriteHTML(file_get_contents("http://localhost/wordpress_Demo/pdf-2/"));
	$mpdf->Output("plan.pdf","D");	
}
?>