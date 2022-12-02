<?php
if (false) {
    include ("kaal.php");
    $kaal = new kaalSocket("192.168.1.153", 4001);
    $ret = $kaal->readWeight();
    $kaal->closeCon();
    echo json_encode(trim($ret));
} else {
    echo "SI 1.1 kg";
    // echo "SI - 0.01 kg"; // negatiivse kaalu simuleerimiseks
}
?>