<h3> Users Manager</h3>


<div class="row">
   
    <div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions &nbsp;&nbsp;&nbsp;<a class="font20" href="<?php echo RESOURCE; ?>/users/create">Add New User </a></th>
                </tr>
            </thead>
            <tbody>
     <?php foreach ($data['users'] as $userslist)  { ?>
       <tr>
           <td><?php echo $userslist->Users; ?></td>
           <td><a href="<?php echo RESOURCE; ?>/users/view/<?php echo $userslist->UserID ?>" >View</a>&nbsp;
           <a href="<?php echo RESOURCE; ?>/users/update/<?php echo $userslist->UserID ?>" >Update</a>&nbsp;
           
           <a id="dlink_<?php echo $userslist->UserID ?>" href="#" class='delLink' >delete</a>

       </tr>
     <?php } ?>
            </tbody>
        </table>
    </div>
      <div class="col-lg-3">&nbsp;</div>
      <form id="rmform" method="POST" action="<?php echo RESOURCE ;?>/home/">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="cntr" value="<?php echo $activeController;?>" >
          <input type="hidden" name="actn" value="rmPost" >
      </form>
</div>

<script>
    $(document).ready(function(){
        $('.delLink').on('click',function(){
             tmp = $(this).attr('id').split('_');
             idToDel = tmp[1];
             $('#id').val(idToDel);
             $('#rmform').submit();
        });
    });
    </script>