<?php

class Sessions {

    //SMS Gateway Globals
    private $gateway_email = "******"; ////your bulksmslive registered email
    private $gateway_password = "******"; //Your bulksmslive password
    private $gateway_senderID = "New Message"; //Your sender name (ID)
    //Other Globals
    public $APP_NAME1 = "Graphical Password Using Intuitive Approach";
    public $APP_NAME2 = "Graphical Password";
    private $DB_USER = "root";
    private $DB_PASSWORD = "";
    private $DB_DSN = "mysql:host=localhost;dbname=graphicalpassword";

    public function getConnection() {
        return (new PDO($this->DB_DSN, $this->DB_USER, $this->DB_PASSWORD));
    }

    public function checkUsername($uname) {
        $conn = $this->getConnection();
        $query = "SELECT * FROM login WHERE userid = ?";
        $ps = $conn->prepare($query);
        $ps->bindParam(1, $uname);
        $ps->execute();
        $result = $ps->fetchAll();
        $res = NULL;
        foreach ($result as $r) {
            $res = $r;
        }
        return ($res != NULL);
    }

    public function userTextLogin($username, $password) {
        $conn = $this->getConnection();
        $query = "SELECT * FROM login WHERE userid = ? and textpassword = ?";
        $ps = $conn->prepare($query);
        $ps->bindParam(1, $username);
        $ps->bindParam(2, $password);
        $ps->execute();
        $result = $ps->fetchAll();
        $res = NULL;
        foreach ($result as $r) {
            $res = $r;
        }
        return $res;
    }

    public function userGraphicalLogin($username, $password) {
        $conn = $this->getConnection();
        $query = "SELECT * FROM login WHERE userid = ? and graphicalpassword = ?";
        $ps = $conn->prepare($query);
        $ps->bindParam(1, $username);
        $ps->bindParam(2, $password);
        $ps->execute();
        $result = $ps->fetchAll();
        $res = NULL;
        foreach ($result as $r) {
            $res = $r;
        }
        return $res;
    }

    public function newLogin($userid, $graphicalpassword, $textpassword, $role) {
        try {
            $conn = $this->getConnection();
            $query = "INSERT INTO login VALUES(?,?,?,?)";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $userid);
            $ps->bindParam(2, $graphicalpassword);
            $ps->bindParam(3, $textpassword);
            $ps->bindParam(4, $role);
            $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function newUser($email, $mobile, $fullname) {
        try {
            $conn = $this->getConnection();
            $query = "INSERT INTO users VALUES(?,?,?)";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            $ps->bindParam(2, $mobile);
            $ps->bindParam(3, $fullname);
            $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSingleUser($email) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM users WHERE email = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            $ps->execute();
            $result = $ps->fetchAll();
            $res = NULL;
            foreach ($result as $r) {
                $res = $r;
            }
            return $res;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function newOTP($token, $expire_date, $user) {
        try {
            $conn = $this->getConnection();
            $query = "INSERT INTO otp(token,expire_date,user,status) VALUES(?,?,?,?)";
            $status = "active";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $token);
            $ps->bindParam(2, $expire_date);
            $ps->bindParam(3, $user);
            $ps->bindParam(4, $status);
            $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function checkOTP($user, $token) {
        try {
            $current_date = date("Y/m/d H:i:s");
            $conn = $this->getConnection();
            $query = "SELECT * FROM otp WHERE token = ? AND user = ? AND expire_date >= ? AND status = 'active'";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $token);
            $ps->bindParam(2, $user);
            $ps->bindParam(3, $current_date);
            $ps->execute();
            $result = $ps->fetchAll();
            $res = NULL;

            foreach ($result as $r) {
                $res = $r['status'];
            }
            return $res;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function deactivateOTP($token) {
        try {
            $conn = $this->getConnection();
            $query = "UPDATE otp SET status = 'inactive' WHERE token = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $token);
            $ps->execute();
            $result = $ps->fetchAll();
            $res = NULL;

            foreach ($result as $r) {
                $res = $r;
            }
            return ($res != NULL);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //---------------------- Start Bulk SMS Operations ---------------------------
    function sendsms_post($params1) {
        $url = 'https://api.bulksmslive.com/v2/app/sms';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($params1)));
        $result = curl_exec($ch);
        $res_array = json_decode($result);

        return $res_array;
    }

    public function sendSMS($mobiles, $message) {
        try {
            $recipients = $mobiles;
            $data = array("email" => $this->gateway_email,
                "password" => $this->gateway_password,
                "message" => $message,
                "sender_name" => $this->gateway_senderID,
                "recipients" => $recipients,
                "forcednd" => "1");
            $data_string = json_encode($data);
            return $this->sendsms_post($data_string);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return NULL;
    }

    //---------------------- End Bulk SMS Operations ---------------------------
    public function generateUnique($char_size) {
        $main_string = "234567890";
        $shuffled_string = str_shuffle($main_string);
        return substr($shuffled_string, 0, $char_size);
    }

}
