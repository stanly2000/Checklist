<?php
?>
<table class="table table-striped table-hover">
    <thead>
        <tr class="success">
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Security Level</th>
            <th>Actions</th>
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
           <a id="dlink_<?php echo $userList->UserID ?>"  href="#" class='delLink' >Delete</a>

           </td>
       </tr>
     <?php } ?>
    </tbody>
</table>

      <div class="col-lg-3">&nbsp;</div>
      <form id="rmform" method="POST" action="<?php echo RESOURCE ;?>/user/index">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="cntr" value="<?php echo $activeController;?>" >
          <input type="hidden" name="actn" value="remove" >
      </form>
</div>

<script>

function confirm_delete() {
	  return confirm('are you sure?');
	}
	
    $(document).ready(function(){
        $('.delLink').on('click',function(){

       	 var answer = confirm("Are you sure you want to delete selected user?.")
       	 if (answer){
             tmp = $(this).attr('id').split('_');
             idToDel = tmp[1];
             $('#id').val(idToDel);
             $('#rmform').submit();
       	 }
        });
    });
    </script>