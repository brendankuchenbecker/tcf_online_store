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
	<link href="css/tableText.css" rel="stylesheet">
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<style>
#turnWhite{background-color:white;}
#matchBackground{background-color:#bbff99;}
</style>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPage.php'" /></center>
</div>
<body>
<?php
$sport = $_SESSION['sport'];
$year = $_SESSION['year'];
$letter = $_SESSION['letter'];

//connect to the db
require ('mysqli_connect.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$num = $_POST['submit'];
		//validate the form input
		if(is_numeric($_POST['tl_update' . $num]) &&
			is_numeric($_POST['nh_update' . $num]) &&
			is_numeric($_POST['ts_update' . $num]))
		{
			$tl_update = $_POST['tl_update' . $num];
			$nh_update = $_POST['nh_update' . $num];
			$ts_update = $_POST['ts_update' . $num];
			
			//make the query:
			$q = "UPDATE $sport SET top_loader=$tl_update, nine_hundred=$nh_update, triple_shoe=$ts_update WHERE id=$num ";
			//run the query
			$r = @mysqli_query ($dbc, $q);
			//if it runs ok print the set updated under the logo
		
			if($r)
			{
				//store the $_SESSION['array'] in a temp array
				$tempArray = array();
				$tempArray = $_SESSION['array'];
				//find the year and set name from the array
				for($j=0; $j < count($tempArray); $j++)
				{
					if($tempArray[$j][0] == $num)
					{echo '<center>' . $tempArray[$j][1] . ' ' . $tempArray[$j][2] . ' has been updated.</center>';}
				}//end of for statement that finds the year and set name
			}//end of if statement that checks to see if the update query ran
		}//end of if statement that validates the form data
		else
		{echo '<center>Error: non-numeric value entered.</center>';}
	}//end if statement that checks to see if the form was submitted
	
	//make the query:
	$q = "SELECT id, year, set_name, top_loader, nine_hundred, triple_shoe
		  FROM $sport
		  WHERE year = $year AND set_name LIKE $letter";
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
		<td id="matchBackground"><form method="post" action="setPage.php">
		<input name="submit" align="left" type="submit" value="Set Page"></td></form>
		</tr>';
		//create a 2 dimmensional array to store the results of the query
		$resultsArray = array();
		$resultsRow = array();
		//initailize the counter
		$counter = 0;
		//fetch and process the query results
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{	
	  //store the query results in the resultsRow array
	  $resultsRow[0] = $row['id'];
	  $resultsRow[1] = $row['year'];
	  $resultsRow[2] = $row['set_name'];
	  $resultsRow[3] = $row['top_loader'];
	  $resultsRow[4] = $row['nine_hundred'];
	  $resultsRow[5] = $row['triple_shoe'];
	  //add the resultsRow array to the resultsArray
	  $resultsArray[$counter] = $resultsRow;	  
	  //update the counter
	  $counter++;
	}//end while statement
	//add the results array to the session array
	$_SESSION['array']=$resultsArray;
	//display the results
	for($i=0; $i < count($resultsArray); $i++)
	{
	  echo '<form method="post" action="updatePage.php">
	  <tr><td id="turnWhite" class="tcf_table" align="left">' . $resultsArray[$i][1] . '</td>
	  <td id="turnWhite" class="tcf_table" align="left">' . $resultsArray[$i][2] . '</td>
	  <td><input name="tl_update' . $resultsArray[$i][0] . '" type="text" class="tcf_table" align="left" value="' . $resultsArray[$i][3] . '"</td>
	  <td><input name="nh_update' . $resultsArray[$i][0] . '" type="text" class="tcf_table" align="left" value="' . $resultsArray[$i][4] . '"</td>
	  <td><input name="ts_update' . $resultsArray[$i][0] . '" type="text" class="tcf_table" align="left" value="' . $resultsArray[$i][5] . '"</td>
	  <td><input name="submit" type="submit" value="' . $resultsArray[$i][0] . '" /></td>
	  </tr>';
	}//end of for loop

	echo '</table></form>'; // Close the table and form
	mysqli_free_result ($r); // Free up the resources.	
	}//end of if statement that checks to see if the query ran ok																				


 else 
	{
		// If it did not run OK.
		// Public message:
		echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';
		// Debugging message:
		echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	}//end of else where query did not run
?>
</body>
</html>