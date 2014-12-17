<?php
$db = new PDO('mysql:host=localhost;dbname=Checklist;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

foreach($db->query('SELECT * FROM tbUser') as $row) {
    echo $row['FirstName'].' '.$row['LastName']; //etc...
}
//test message

//
//$result = mysql_query('SELECT * from tbUser') or die(mysql_error());
// 
//$num_rows = mysql_num_rows($result);
// 
//while($row = mysql_fetch_assoc($result)) {
//   echo $row['FirstName'].' '.$row['LastName'];
//}
?>
