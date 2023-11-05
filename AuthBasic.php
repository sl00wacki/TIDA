<?php
require_once 'DataBaseConn.php';

class AuthBasic{

    var $authCode = "";
    var $email = "";
    var $id = "";

    function genFingerprint(string $algo){

    }

    public function createCode($length=6, $min=1, $max=999999){
        $max = substr($max,0,$length);
        $authCode = str_pad(mt_rand($min,$max),$length,'0',STR_PAD_LEFT);

    }

    public function createAuthToken(string $email, $id){
        $this->email = $email;
        $this->id = $id;

        $db = new DataBaseConn();
        $pdo = $db->DatabaseConn($db->host, $db->user, $db->pass, $db->database);

        $data = [
            'email' => $this->email,
            'id' => $this->id,
            'authCode' => $this->createCode(),
            'authDate' => date("Y-m-d"),
        ];

        $table = 'auth_tokens';
        $db->put($pdo, $table, $data);
    }

    function compAuthCode($authCode){
        if ($this->authCode === $authCode){
            return true;
        } else return false;
    }

    function doAuthByEmail($email, $id){
        if($this->email === $email || $this->id === $id){
            return true;
            echo "dane się zgadzają";
        } else {
            return false;
            echo "id, lub email są niepoprawne";
        }
    }

    function checkIfValidRequest(){

    }

    function checkIfValidRequest2f(){

    }

    function verifyQuickRegCode(int $codeNo){

    }
}
?>
