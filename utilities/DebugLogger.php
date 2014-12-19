<?php

/**
 *
 * @author Stan
 */
class DebugLogger {

    public static $file = "/tmp/log.txt";
    
    private static $depth;
    
    public static function log($message){
        $fp = fopen(self::$file,"a");
    fwrite($fp, date('h:i:s A').':   '.$message."\n");
    fclose($fp);
    }
    
    public static function logAr($arr = []){
        self::$depth = 0;
        $fp = fopen(self::$file,"a");
        fwrite($fp, "\n******************** START ARRAY PRINTING *******************\n");
        foreach ($arr as $key=>$val) {
            fwrite($fp, '['.$key."]=>");
            if (is_array($val)){
                fwrite($fp, "\n");
                self::printInnerArray($val);
            }
            else
            fwrite($fp, $val."]\n");
        }
        fwrite($fp, "******************** END ARRAY PRINTING *******************\n\n");
    fclose($fp);
    }
    
    private static function printInnerArray($ar){
        self::$depth++; 
        $fp = fopen(self::$file,"a");       
        foreach ($ar as $key => $val) {         
            fwrite($fp, str_repeat(" ", self::$depth*10).'['.$key."]=>");
            if (is_array($val)){
                self::printInnerArray($val);
            }
            else{
                fwrite($fp, $val."\n");
            } 
        }
        self::$depth--; 
        fclose($fp);
    }
}
