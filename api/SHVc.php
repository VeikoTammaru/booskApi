<?php
// TODO: $_GET väärtuskontroll

include ("../config.php");
$fields =""; //"fields=SerNr"
if(isset($_GET["fields"])){
    $fields= "fields=". $_GET["fields"];
}

$filter = "";
if (isset($_GET["filter"])) {
    $filter = urldecode($_GET["filter"]);

} else {
    if (isset($_GET["SerNr"])){
        if (preg_match("/^[0-9]+$/i", $_GET["SerNr"])) {
            if (debug) {
                $filter = $_GET["SerNr"];
            } else {
                $filter = "filter.SerNr=".$_GET["SerNr"];
            }
        } 
    }
}

 define ("tabel" ,"SHVc");
 define ("fields",$fields);
 define ("filter", $filter);
 define ("Method","GET");

 include ('../paring.php');
?>