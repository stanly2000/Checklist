<?php

class Task { 
     public $db;
     public $TaskID;
     public $Name;
     public $ChecklistID;
     public $Time;
     
      function __construct($db) {
        $this->db = $db;
    }
