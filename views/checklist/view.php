

<?php
//echo"<pre>";
//var_dump($data['checklist']->Tasks);
//echo "</pre>";
if ($data['checklist']){
echo "There there  <b>" .$data['checklist']->ChecklistName. "</b>";
echo "<ul>";
foreach($data['checklist']->Tasks as $task){
    echo "<li>".$task->TaskName."($task->TaskID)</li>";
}
echo "</ul>";
}
else {
echo "nobody there";
}



