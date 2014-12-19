<?php

/**
 * Description of Validation
 *
 * @author Stan
 */
class Validation {
   private $ErrorsList = [];
   
   public function getErrors(){
       return $this->ErrorsList;
}
   // rules 'FirstName'=>['notEmpty','string'], '
   public function validate($fields = [], $rulesArray = []){
       foreach ($rulesArray as $param => $ruleList){
           foreach($ruleList as $rule){
               $this->$rule($param, $fields[$param]);
           }
       }
       return (count($this->ErrorsList) == 0);
   }
   
   public function notEmpty($fieldName, $value){
      if ($value == null){
          array_push($this->ErrorsList, $fieldName. ' have to be filled.');
      }
   }
   
   public function email($fieldName, $value){
       if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
           array_push($this->ErrorsList, ' invalid email.');
       }
   }
   
   public function isInteger($fieldName, $value){
       if (!filter_var($value, FILTER_VALIDATE_INT)) {
           array_push($this->ErrorsList, $fieldName.' has to be an integer.');
       }
   }
   
   public function isFloat($fieldName, $value){
       if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
           array_push($this->ErrorsList, $fieldName.' has to be a number.');
       }
   }
   
   public static function sanitizeString($mode = 1){
       
   } 
}
