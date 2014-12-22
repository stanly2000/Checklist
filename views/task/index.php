<?php
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>TaskID</th>
            <th>TaskName</th>
            <th>ChecklistID</th>
            <th>TaskTime</th>           
        </tr>
    </thead>
    <tbody>
     <?php foreach ($data['tasks'] as $taskList)  { ?>
       <tr>
           <td><?php echo $taskList->ChecklistName; ?></td>
           <td>
           <a href="<?php echo RESOURCE; ?>/task/edit/<?php echo $taskList->TaskID ?>" >view</a>||&nbsp;
           <a href="<?php echo RESOURCE; ?>/task/update/<?php echo $taskList->TaskID ?>" >update</a>||&nbsp;
           <a href="<?php echo RESOURCE; ?>/task/delete/<?php echo $taskList->TaskID ?>" >delete</a>
           </td>
       </tr>
     <?php } ?>
    </tbody>
</table>