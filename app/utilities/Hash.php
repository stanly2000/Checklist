<?php

/**
 *
 * @author Stan
 */
class Hash
{

    public static function genSalt()
    {
        $length = 16;
        
        return substr(str_replace('+', '.', base64_encode(md5(mt_rand(), true))), 0, 16);
    }

    public static function genHash($password, $salt)
    {
        if (CRYPT_SHA512 != 1) {
            die("Can't find hash function!");
        } else {
            $rounds = 6666;
            return crypt($password, '$6$rounds=' . $rounds . '$' . $salt);
        }
    }
}
