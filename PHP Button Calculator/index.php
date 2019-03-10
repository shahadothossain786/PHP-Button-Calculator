<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Basic PHP Calculator</title>
<style>
	body{
		margin:0 auto;
	}
	h1{
		text-align:center;
		margin-top:50px;
	}
	table{
		width:400px;
		height:500px;
		margin:100px auto;
		border:4px solid #675252;
	}
	td{
		font-size:40px;
		padding: 10px 10px;
		background:#1F1F1F;
		color:#fff;
		border:1px solid #444;
		height:50px;
	}
	button{
		padding:15px 20px;
		margin: 0px 20px;
		font-size: 30px;
		background:#1F1F1F;
		color:#fff;
		
	}
	button:hover{
		color:#fff;
		background:#4F4F4F;
	}
</style>
</head>
<body>
<h1>Basic PHP Calculator</h1>
<?php
/*create all buttons array variable
*including operators and C.
*/
$buttons=[1,2,3,'+',4,5,6,'-',7,8,9,'*','C',0,'.','/','=']; //array variable
$clicked='';//button clicked a blank variable
//checked clicked variable and checked the array variable in in_array function  
if(isset($_POST['clicked']) && in_array($_POST['clicked'],$buttons)){
    $clicked=$_POST['clicked'];
}
$stored='';//clicked variable values stored in a blank variable
/*checked stored variable and checked the array function preg_match
*preg_match is a regularExpression functon which declare the string pattern.
*~^ means start at the first or begining 
*\d*\.? means data type(int) and * means zero or more and . is concate
*\d+ means data type(int) at least one or more 
* +-/* the operators
*$ at the ends of it.
*/
if(isset($_POST['stored']) && preg_match('~^(?:[\d.]+[*/+-]?)+$~',$_POST['stored'],$out)){
    $stored=$out[0];    
}
$display=$stored.$clicked;//display the value and operators and answer
//Reset-C- condition
if($clicked=='C'){
    $display='';
}elseif($clicked=='=' && preg_match('~^\d*\.?\d+(?:[*/+-]\d*\.?\d+)*$~',$stored)){
    $display.=eval("return $stored;");//eval — Evaluate a string as PHP code 
}
//the output form
echo "<form action=\"\" method=\"POST\">";
    echo "<table>";
        echo "<tr>";
            echo "<td colspan=\"4\">$display</td>";
        echo "</tr>";
		/*array_chunk-- Split an array into chunks
		*seperate the buttons values
		*And create tr.
		*/
        foreach(array_chunk($buttons,4) as $chunk){
            echo "<tr>";
			//sizeof use for count the chunk value...
                foreach($chunk as $button){
                    echo "<td",(sizeof($chunk)!=4?" colspan=\"4\"":""),"><button name=\"clicked\" value=\"$button\">$button</button></td>";
                }
            echo "</tr>";
        } 
    echo "</table>";
    echo "<input type=\"hidden\" name=\"stored\" value=\"$display\">";
echo "</form>";
?>
</body>
</html>