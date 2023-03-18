<?php

function validate($encrypted = '') {
    $secret_key = '9iwjwj455aufj4669gkfmdfkl244h45t';

    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($secret_key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($secret_key))
            ), "\0");
    return $decrypted;
}

function securevalidate($string = '') {
    $secret_key = '9iwjwj455aufj4669gkfmdfkl244h45t';

    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($secret_key), $string, MCRYPT_MODE_CBC, md5(md5($secret_key))
            )
    );
    return $encrypted;
}

function servervalidate() {
    if (ACCESSKEY != NULL) {
        if ($_SERVER['SERVER_ADDR'] != validate(ACCESSKEY)) {
            echo '<script type="text/javascript">window.location = "access_denied.php";</script>';
        }
    }
}

?>