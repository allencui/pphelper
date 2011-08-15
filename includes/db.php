<?php
session_start();

$dbname="pphelper";
$host="localhost";
$pass = "yy60241";
$user = "root";

$dbh=mysql_connect ($host,$user,$pass) or die ('Cannot connect to the database because: ' . mysql_error());
mysql_select_db ("$dbname") or die('Cannot select the database because: ' . mysql_error());

function rangen(){

$alphanum = "ILOVEMYSWEATHEARTTAOTAOFOREVER20081124";

// generate the verication code 
$rand = substr(str_shuffle($alphanum), 0, 5);

// create the hash for the random number and put it in the session
$_SESSION['randval'] = md5($rand);

return $rand;
}

function checkuname($aname){
if(!eregi('^[[:alpha:]\.\'\-]{2,8}$',$aname)){return FALSE;
}else{
return TRUE;
}
}


function checkEmail($email){
if(eregi('^[[:alnum:]][a-z0-9_\.\-]*@[a-z0-9\.\-]+\.[a-z]{2,8}$',$email)){
return TRUE;
}else{
return FALSE;
}

}

function checkurl($url){
if(eregi('^([[:alnum:]\-\.])+(\.)([[:alnum:]]){2,4}([[:alnum:]/+=%&_\.~?\-]*)$',$url) 
OR eregi('^((http|https|ftp)://)([[:alnum:]\-\.])+(\.)([[:alnum:]]){2,4}([[:alnum:]/+=%&_\.~?\-]*)$',$url) ){
  
    return TRUE;
  }else{
  return FALSE; 
   }
   }

?>
 