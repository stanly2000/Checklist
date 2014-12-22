<?php
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Security Level</th>
        </tr>
    </thead>
    <tbody>
     <?php foreach ($data['user'] as $userList)  { ?>
       <tr>
           <td><?php echo $userList->UserID; ?></td>
           <td><?php echo $userList->FirstName; ?></td>
           <td><?php echo $userList->LastName; ?></td>
           <td><?php echo $userList->Email; ?></td>
           <td><?php echo $userList->SecurityLevel; ?></td>           
           <td>
           <a href="<?php echo RESOURCE; ?>/user/view/<?php echo $userList->UserID ?>" >View</a>&nbsp;||&nbsp;
           <a href="<?php echo RESOURCE; ?>/user/update/<?php echo $userList->UserID ?>" >Update</a>&nbsp;||&nbsp;
           <a href="<?php echo RESOURCE; ?>/user/delete/<?php echo $userList->UserID ?>" >Delete</a>

           </td>
       </tr>
     <?php } ?>
    </tbody>
</table>