<?php

setcookie("PHPSESSION", encrypt('thecookiedata', 'longsecretsalt'));

function encrypt($text, $salt) 
{ 
    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))); 
} 

function decrypt($text, $salt) 
{ 
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
}



//* save the cookie

setcookie("PHPSESSION", encrypt('thecookiedata', 'longsecretsalt'));

//* read on the next page:

$data = decrypt($_COOKIE['PHPSESSION'], 'longsecretsalt');



class SessionClass {

    private static $_instance;
    public static function getInstance() 
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // getInstance


    public function __construct()
    {
        setsession_set_save_handler(
            array($this, "open"), array($this, "close"),
            array($this, "read"), array($this, "write"),
            array($this, "destroy"), array($this, "gc")
        );

        $createTable = "CREATE TABLE IF NOT EXISTS `setsession`( ".
                            "`ssID` VARCHAR(128), ".
                            "`data` MEDIUMBLOB, ".
                            "`timestamp` INT, ".
                            "`ip` VARCHAR(15), ".
                            "PRIMARY KEY (`ssID` ), ".
                            "KEY (`timestamp`, `ssID`))";

        mysql_query($createTable);
    } // construct


    public function __destruct() {
        setsession_write_close();
    }

    public function open ($path, $id) {
        // do nothing
        return (true);
    }

    public function close() {
        // do nothing
        return (true);
    }

    public function read($id) 
    {
        $escapedID = mysql_escape_string($id);
        $query = sprintf("SELECT * FROM setsession WHERE ssID = '%s'", $escapedID);
        $res = mysql_query($query);

        if ((!$res) || (!mysql_num_rows($res))) {
            $timestamp = time();
            $query = sprintf("INSERT INTO setsession (ssID, timestamp) VALUES ('%s', %s)", $escapedID, $timestamp);
            mysql_query($query);
            return '';
        } elseif (($row = mysql_fetch_assoc($res))) {
            $query = "UPDATE setsession SET timestamp = ";
            $query .= time();
            $query .= sprintf (" WHERE ssID = '%s'", $escapedID);
            mysql_query($query);
            return $row['data'];
        } // elseif

        return "";
    } // read


    public function write($id, $data)
    {
        $query = "REPLACE INTO setsession (ssID, data, ip, timestamp) ";
        $query .= sprintf("VALUES ('%s', '%s', '%s', %s)", 
            mysql_escape_string($id), mysql_escape_string($data),
            $_SERVER['REMOTE_ADDR'], time());
        mysql_query($query);
        return (true);
    } // write


    public function destroy($id)
    {
        $escapedID = mysql_escape_string($id);
        $query = sprintf("DELETE FROM setsession WHERE ssID = %s", $escapedID);
        $res = mysql_query($query);
        return (mysql_affected_rows($res) == 1);
    } // destroy


    public function gc($lifetime)
    {
        $query = "DELETE FROM setsession WHERE ";
        $query = sprintf("%s - timestamp > %s", time(), $lifetime);
        mysql_query($query);
        return (true);
    } // gc

} // SessionClass