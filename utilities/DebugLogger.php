<?php

/**
 *
 * @author Stan
 */
class DebugLogger {

    public static $file = "/tmp/log.txt";
    
    public static function log($message){
        $fp = fopen(self::$file,"a");
    fwrite($fp, $message."\n");
    fclose($fp);
    }
    
    public static function logAr($arr = []){
        $fp = fopen(self::$file,"a");
        fwrite($fp, "\n******************** START ARRAY PRINTING *******************");
        foreach ($arr as $value) {
            fwrite($fp, $value."\n");
        }
        fwrite($fp, "\n******************** END ARRAY PRINTING *******************/n/n");
    fclose($fp);
    }
}
