<?php
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>UserID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Security Level</th>
        </tr>
    </thead>
    <tbody>
     <?php foreach ($data['users'] as $userList)  { ?>
       <tr>
           <td><?php echo $userList->ChecklistName; ?></td>
           <td>
           <a href="<?php echo RESOURCE; ?>/user/edit/<?php echo $userList->UserID ?>" >view</a>||&nbsp;
           <a href="<?php echo RESOURCE; ?>/user/update/<?php echo $userList->UserID ?>" >update</a>||&nbsp;
           <a href="<?php echo RESOURCE; ?>/user/delete/<?php echo $userList->UserID ?>" >delete</a>
           </td>
       </tr>
     <?php } ?>
    </tbody>
</table>