<!DOCTYPE html PUBLIC "-//W3C//
DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/
xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/
1999/xhtml" xml:lang="en"
lang="en">
<head>
	<meta http-equiv="Content-Type"
	content="text/html;
	charset=utf-8"  />
	<link href="css/tcf_header.css" rel="stylesheet">
	<link href="css/tcf_background.css" rel="stylesheet">
	<link href="css/tcf_buttons.css" rel="stylesheet">
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<style>
#hiddenB{visibility: hidden;}
</style>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPageV2.php'" /></center>
</div>
<body>
<p>
<form method="get" action="letterPageV2.php" align="center">
<?php
$counter = 0;//create a counter to put paragraph breaks between the rows
for($i = 1960; $i < 2019; $i++)
{
	if($counter == 10)
	{
		$counter = 0;
		echo '</p><p>';
	}
	
	if($i <= 2015)
	{
		echo '<input name="year" type="submit" class="medium blue button" value="' . $i . '" />';
	}
	else
	{
		echo '<input id="hiddenB" name="year" type="submit" class="medium blue button" value="' . $i . '" />';
	}
	$counter++;
}
echo '<input name="year" type="submit" class="medium blue button" value="%" />';
?>
</p>
</form>

<?php
//add the sport choosen from the first page to the SESSION array
$_SESSION['sport'] = $_GET['sport'];
?>
</body>
</html>