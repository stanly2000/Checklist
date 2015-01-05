<h3>Assigned Checklists</h3>

<div class="row">
   
    <div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-6">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="success">
                    <th>Assigned ID</th>
                    <th>Group Name</th>
                    <th>Checklist ID</th>
                    <th>Checklist Name</th>
                    <th>Date Assigned</th>
                    <th>Actions (View, Update, Delete)</th>
                </tr>
            </thead>
            
            <tbody>
     <?php foreach ($data['assignedChecklist'] as $assignedChecklist)  { ?>
       <tr>
           <td><?php echo $assignedChecklist->AssignID; ?></td>
           <td><?php echo $assignedChecklist->GroupName; ?></td>
           <td><?php echo $assignedChecklist->ChecklistID; ?></td>
           <td><?php echo $assignedChecklist->ChecklistName; ?></td>
           <td><?php echo $assignedChecklist->AssignTime; ?></td>
           <td><a href="<?php echo RESOURCE; ?>/assignedChecklist/view/<?php echo $assignedChecklist->AssignID ?>" >view</a>&nbsp;
           <a href="<?php echo RESOURCE; ?>/assignedChecklist/update/<?php echo $assignedChecklist->AssignID ?>" >update</a>&nbsp;
           
           <a id="dlink_<?php echo $assignedChecklist->AssignID ?>" onclick="return confirm('Are you sure you want to Delete Assigned Checklist?');" href="#" class='delLink' >delete</a>

       </tr>
     <?php } ?>
            </tbody>
        </table>
    </div>
    
     <div class="col-lg-3">&nbsp;</div>
      <form id="rmform" method="POST" action="<?php echo RESOURCE ;?>/home/index.php">
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