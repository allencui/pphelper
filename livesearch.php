<?php
require "includes/class.buy360.php";
header('Content-Type:text/html;charset=GB2312');
//get the q parameter from URL
$url=$_GET["q"];
if (strlen($url)==0)
	die("No URL entered.");
	
$buy360 = new buy360();

if ($buy360::isValidUrl($url)==false) 
	die("Invalid Url!");

//echo "<form action=\"user_product.php\" method=\"post\" onsubmit=\"return checkForm()\" >";

if ($buy360::isProductUrl($url)==true){  //Only one single product should be captured.
  $pinfo =$buy360::getProductInfo($url);
  echo $pinfo["title"]."\r\n".$pinfo["price"]."\r\n".$pinfo["url"];
  }
else { //Multiple products. Take time to load.
	$plist=$buy360::getProductList($url); //pid,title,url
	echo "<table border=1px><tr><td><input type="."\"checkbox\""." id=\"chkall\" onclick=\"checkAll()\" /></td><td>Title</td><td>Price</td></tr>";
	for ($i=0;$i<count($plist[0]);$i++){
		echo "<tr><td><input type="."\"checkbox\""." name=\"pid[]\" value=\"" .$plist[0][$i]. "\" /></td><td><a href=\"".$plist[2][$i]. "\" target=\"_blank\">".$plist[1][$i]. "</a></td><td>". "Get Price!"."</td></tr>";		
	}
	echo "</table>";
	//	$pinfo =$buy360::getProductInfo($purl);
}

//echo "<p>«Î ‰»Î” œ‰µÿ÷∑: <input type=\"text\" size=\"30\" id=\"email\" /></p>";
//echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />";
//echo "</form>";



?>