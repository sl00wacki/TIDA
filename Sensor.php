<?php
class Sensor{

    var $fingerPrint = "";

    function isLocal($serverAddress){
        if ($serverAddress === '127.0.0.1' || $serverAddress === '::1') {
            return true;
        } else {
            return false;
        }
    }

    function addrIp(){
        $ip = $_SERVER['REMOTE_ADDR'];
        $forwardedFor = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';
    }

    function browser(){
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
    }

    function system(){
        $system = PHP_OS;
    }

    function genFingerprint() {
        $algorithm = 'sha512';
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $hash = hash_hmac($algorithm, $userAgent, true);
        $fingerPrint = base64_encode($hash);
        $this->fingerPrint = $fingerPrint;
    }
}
