
<?php
$serverName = "119.59.115.80";
   		$userName = "sa";
   		$userPassword = "ASDF@edc18";
   		$dbName = "TLE_CLEANMATE_TEST";

$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');

$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn == false ) {
  die("Error connect to Database");
}
?>
