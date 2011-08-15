<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN" xml:lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312" />
<meta name="description" content="" />
<meta name="keywords" content="price protect,price alert,360buy.com,money-saving,email notification" />
<title>pphelper - Save money with price alerts!</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/tab.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/calendar.css" media="screen" />
<script type="text/javascript" src="js/calendar_db.js"> </script>
<script type="text/javascript" src="js/tabber.js"> </script>
<script type="text/javascript" src="js/main.js"> </script>
<script type="text/javascript" src="js/date.format.js" > </script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
$().ready(function() {
	// if text input field value is not empty show the "X" button
	$("#userurl").keyup(function() {
		$("#x").fadeIn();
		if ($.trim($("#userurl").val()) == "") {
			$("#x").fadeOut();
		}
	});
	// on click of "X", delete input field value and hide "X"
	$("#x").click(function() {
		$("#userurl").val("");
		$(this).hide();
	});
});
</script>
</head>

<body>
<?php include('includes/header.php'); ?>

<div class="mainleft">
	<h2>Save money with price alerts!</h2>
	<p>Use pphelper(Price Protect Helper) to track prices of things you're thinking about buying, and save money even after you buy.</p> 
	<p>There are lots of stores out there that offer price protection policies -- when the price drops on an item you've purchased, they'll refund you the difference. But there's a catch... it's up to you to watch prices.</p> 
	<p>pphelper makes it simple to watch prices, keep track of your purchases, and get rebates off price drops. </p>
</div>

<div class="mainright">

	<div id="step1">
		<h2>Three easy steps to go:</h2>
		<p><span class="steps" >step 1: Find the product information page</span> for your item (the page where you can add it to your shopping cart) and copy and paste the URL here, 
		say http://www.360buy.com/product/497462.html</p>

		<div id="searchContainer">
			<table><tr><td>
			<input id="userurl" type="text" size="70" onkeyup="if(checkEnter(event)){showResult(this.value);};" />
			<div id="delete"><span id="x">x</span></div>
			<input type="button" name="submit" id="submit" value="Search" onclick="showResult(document.getElementById('userurl').value);" />
			</td>
			<td><img id="loadingImg" src="./images/s.gif" alt="loading.." style="vertical-align: middle;display:none;" ></img>&nbsp;</td></tr>
			<tr><td><input name="noname" type="text" value="" style="display:none" /> </td><td></td></tr>
			</table>
		</div>
		<div class="fclear"></div>
	</div>


<div id="step2" style="display:none;">
	<span class="steps" >step 2: config your protection below</span> by either price protect, price target or price watch
	
	<div id="plist">&nbsp;</div>
	
	<div id="ppinfo" class="tabber" style="display:none;">
     <div class="tabbertab">
	  <h2>price protect</h2>
	  <p>you bought <span id="pptitle1" class="proinfo">&nbsp;</span></p>
	  <p>you paid <input class="mpinfo" type="text" id="ppprice1" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="activeInput('ppprice1')" >pay a different price?</a></p>
	  <form name="calform">
	  <p>purchased<input class="mpinfo" type="text" id="ppdate1" name="ppdate1" />
		<script type="text/javascript">
		document.getElementById('ppdate1').value= (new Date()).format('yyyy-mm-dd');
		new tcal ({'formname': 'calform','controlname': 'ppdate1',}); 
		</script> 
		</p></form>
     </div>
     <div class="tabbertab">
	  <h2>price target</h2>
	  <p>item <span id="pptitle2" class="proinfo">&nbsp;</span></p>
	  <p>target price <input class="mpinfo" type="text" id="ppprice2" />&nbsp;&nbsp;&nbsp;<a href="#" onclick="activeInput('ppprice2')" >choose a different target?</a></p>
	  <p>target for <input class="mpinfo" type="text" id="ppdur2" value="15" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="activeInput('ppdur2')" >change duration?</a></p>
     </div>
	 
	 <div class="tabbertab">
	  <h2>price watch</h2>
	  <p>item <span id="pptitle3" class="proinfo">&nbsp;</span></p>
	  <p>current price <input class="mpinfo" type="text" id="ppprice3" /></p>
	  <p>watch for <input class="mpinfo" type="text" id="ppdur3" value="15">&nbsp;</input>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="activeInput('ppdur3')" >change duration?</a></p>
     </div>

	 <div class="tabbertab">
	  <h2>help</h2>
	  <p>Price Protect - Choose this if you've bought the item. We'll watch the price for the duration of the retailer's policy length and notify you any time the price drops. </p>
	  <p>Price Target - Choose this and we'll notify you when the price for this item drops below your specified target price. </p>
	  <p>Price Watch - Choose this and we'll notify you any time the price for this item changes. </p>
     </div>
	</div>
	
</div>

	
	<div id="uemail" style="display:none;" >
		<p><span class="steps">step 3: submit your email </span><input id="useremail" type="text" size="20" onkeyup="if(checkEnter(event)){submitAll();};" />
		<input type="button" class="gbtnsubmit" value="I'm done!" style="cursor:pointer;" onclick="submitAll()" /></p>
	</div>	

</div>

<?php include('includes/footer.php'); ?>
</body>
</html>