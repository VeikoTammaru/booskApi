<?php

class kaalSocket {

    // TODO cmd OMS + SM
    // TODO Tegevused kui on ootamatult rohkem tagastusi.

    function __construct($ip, $port) {
        $this->fp = fsockopen($ip, $port, $errno, $errstr, 2);

        if (!$this->fp) {
          echo "$errstr ($errno)<br>";
          exit(); // TODO: Dangerous
        }
    }

    public function setTare($tareVal) {
        //TODO: check if $tareVal is in range
        //TODO: check if response is OK
        $this->sendCmd('UT '.$tareVal);
        $data = $this->readFromSocket();
        return $data;
    }

    public function readTare() {
        $cmd = 'OT';
        $this->sendCmd($cmd . $this->calcCrc($cmd));
        return $this->readFromSocket();
        
    }

    public function scaleZero() {
        $this->sendCmd('Z');
        $data = $this->readFromSocket();
        sleep(0.1);
        $data .= $this->readFromSocket();
        return $data;
    }

    public function readWeight() {
        $cmd = 'SI';
        $this->sendCmd($cmd );
        $data = $this->readFromSocket();
        return $data;
        /* //ei ole usaldusväärne
        $weigth = substr($data,11, 10-strpos($data, ' ',11)-1);
        $unit = trim(substr($data, strpos($data, ' ',11)));
        return [
            $weigth, 
            $unit
        ];
        */
    }

    protected function sendCmd($cmd) {
        $cmdString = $cmd . "\r\n";
        fwrite($this->fp, $cmdString);
    }

    protected function calcCrc($string) {
        $len = strlen($string) - 1;
        $crc = 0x00;
        $i = 0;
        while ($len--) {
            $extract = ord($string[$i]);
            for ($t = 8; $t; $t--) {
            $sum = ($crc ^ $extract) & 0x01;
            $crc >>= 1;
            if ($sum) {
            $crc ^= 0x8C;
            }
            $extract >>= 1;
            }
            $i++;
        }
        
        return $crc;
    }

    protected function readFromSocket() {
        //TODO: what if failes?
        return fgets($this->fp, 100);
    }

    public function closeCon(){
        fclose($this->fp);
    }
}

//$kaal = new kaalSocket("192.168.1.153", 4001);
//var_dump($kaal->scaleZero());
/*
    var_dump($kaal->readTare());
*/
//print("<br>");
//$ret = $kaal->readWeight();
//var_dump($ret);
//$kaal->closeCon();
?>