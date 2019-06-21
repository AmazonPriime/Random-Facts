<?php
    function checkuuid($id) {
        $servername="localhost"; 									
        $username="root";        									
        $password="usbw";            								
        $database="randomfacts";  									
        $link=mysql_connect($servername,$username,$password);
        
        if(! $link){
            die('Connection Failed'.mysql_error());
        }
        
        mysql_select_db($database,$link);
        
        $query = "SELECT uuid FROM users WHERE uuid='$id'";
        
        $rows = mysql_query($query) or die(mysql_error());
        
        if (mysql_num_rows($rows)==0){
            mysql_close($link);
            return false;
        }else{
            mysql_close($link);
            return true;
        }
    }

    function connectdb() {
        $servername="localhost"; 									
        $username="root";        									
        $password="usbw";            								
        $database="randomfacts";  									
        $link=mysql_connect($servername,$username,$password);
        
        if(! $link){
            die('Connection Failed'.mysql_error());
        }
        
        mysql_select_db($database,$link);
        
        return $link;
    }

    function getusername($uuid) {
        $query = "SELECT username FROM users WHERE uuid='$uuid'";
        
        $rows = mysql_query($query) or die(mysql_error());
        
        $users = mysql_fetch_array($rows);
        
        if (mysql_num_rows($rows)==0){
            return "Unknown";
        }else{
            return $users['username'];
        }
    }

    function generate_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    function responded($uuid, $factid) {
        $query = "SELECT responseid FROM responses WHERE uuid='$uuid' and factid='$factid'";
        
        $rows = mysql_query($query) or die(mysql_error());
        
        $users = mysql_fetch_array($rows);
        
        if (mysql_num_rows($rows)==0){
            return false;
        }else{
            return true;
        }
    }
?>