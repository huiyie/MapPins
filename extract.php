<?php include "base.php"; ?>
<?php
//Initialize your first couple variables
$encodedString = ""; //This is the string that will hold all your location data
$x = 0; //This is a trigger to keep the string tidy
 
//Now we do a simple query to the database
$result = mysql_query("SELECT * FROM all_markers WHERE user = '".$username."'");
 
//Multiple rows are returned
while ($row = mysql_fetch_array($result, MYSQL_NUM)){
    //This is to keep an empty first or last line from forming, when the string is split
    if ( $x == 0 ){
         $separator = "";
    }else{
         //Each row in the database is separated in the string by four *'s
         $separator = "****";
    }
    //Saving to the String, each variable is separated by three &'s
    $encodedString = $encodedString.$separator.
    "<p class='content'><h1> ".$row[2].			
    "</h1><br><p>".$row[3].		
    "</p>&&&".$row[4]."&&&".$row[5]; 	
	
	//NAME
	//DESCRIPTION
	//LAT LNG
    $x = $x + 1;
}
?>
