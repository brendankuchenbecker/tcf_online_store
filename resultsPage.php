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
	<link href="css/tcf_table_header.css" rel="stylesheet">
	<link href="css/tcf_table.css" rel="stylesheet">
	<link href="css/tcf_buttons.css" rel="stylesheet">
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPageV2.php'" /></center>
</div>
<body>
<?php
//check to see what letter was choosen on the previous page
//and format the $letter variable accordingly
if($_GET['letter'] == '%')
{$letter = '\''. $_GET['letter']. '\'';}
else{$letter = '\''. $_GET['letter']. '%\'';}
///add the year choosen from the previous page to the SESSION array
$_SESSION['letter'] = $letter;
$sport = $_SESSION['sport'];
$year = $_SESSION['year'];

//connect to the db
require ('mysqli_connect.php');
		
//make the query:
$q = "SELECT year, set_name, top_loader, nine_hundred, triple_shoe
      FROM $sport
	  WHERE year = $year AND top_loader > 0 AND set_name LIKE $letter ORDER BY year ASC, set_name ASC";
//run the query
$r = @mysqli_query ($dbc, $q);
//if it runs ok, display the records
if ($r)
{
//table header
  echo '<table class="tcf_table_header" align="center" cellspacing="3" cellpadding="3" width="75%">
	<tr class="tcf_table_header">
	<td class="tcf_table_header" align="left"><b>Year</b></td>
	<td class="tcf_table_header" align="left"><b>Set</b></td>
	<td class="tcf_table_header" align="left"><b>Top Loader</b></td>
	<td class="tcf_table_header" align="left"><b>900 Box</b></td>
	<td class="tcf_table_header" align="left"><b>Triple Shoe</b></td>
	</tr>';
 //fetch and print all the records:
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
  {
	  echo '<tr><td class="tcf_table" align="left">' . $row['year'] . '</td>
	  <td class="tcf_table" align="left">' . $row['set_name'] . '</td>
	  <td class="tcf_table" align="left">' . $row['top_loader'] . '</td>
	  <td class="tcf_table" align="left">' . $row['nine_hundred'] . '</td>
	  <td class="tcf_table" align="left">' . $row['triple_shoe'] . '</td>
	  </tr>';
	}
echo '</table>'; // Close the table.
	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If it did not run OK.

	// Public message:
	echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';
	
	// Debugging message:
	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
}

?>
</body>
<div>
<p></p>
<center><input name="Update" type="submit" class="medium blue button"
onclick="window.location.href='updatePage.php'" value="Update" /></center>
</div>
</html>