<?php

/*
 * Author: Quan Van Sinh
 * Email : qvsinh@gmail.com
 * Mobile: 0972405165
 */

class contact {

    function contact() {
        
    }

    function addContact(){
        global $db,$validate;
        if(isset($_POST['email'])){
            $fullname = $_POST['name'];
            $email = $_POST['email'];
            $content = $_POST['message'];
            $captcha = $_POST['captcha'];
            if(empty($fullname)){
                $_SESSION['error'][] = 'Please input your name';
            }
            if(!$validate->email($email)){
                $_SESSION['error'][] = 'Your email is not valid';
            }
            if(empty($content)){
                $_SESSION['error'][] = 'Please input content';
            }
            if(strtolower($_SESSION['captcha'])!=strtolower($captcha)){
                $_SESSION['error'][] = 'Secure code is not valid';
            }

            if(count($_SESSION['error'])==0){
                $sql = "INSERT INTO contact_message SET name='$fullname',email='$email',message='$content'";
                $db->query($sql);
                $_SESSION['success'] = 'Thanks you, your message have been sent.';
            }
        }
    }
}

?>
