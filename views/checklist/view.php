
<div class="row">
   
    <div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-8">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions &nbsp;&nbsp;&nbsp;<a class="font20" id="addTask" href="<?php echo RESOURCE; ?>/checklist/add">Add New </a></th>
                </tr>
            </thead>
            <tbody>
     <?php foreach ($data['checklist']->Tasks as $task)  { ?>
       <tr>
           <td><?php echo $task->TaskName; ?></td>
           <td><a href="<?php echo RESOURCE; ?>/checklist/view/<?php echo $task->TaskID ?>" >view</a>&nbsp;
           <a class="editTask" href="<?php echo RESOURCE; ?>/checklist/update/<?php echo $task->TaskID ?>" >update</a>&nbsp;
           
           <a id="dlink_<?php echo $task->TaskID ?>" href="#" class='removeTask' >delete</a>

       </tr>
     <?php } ?>
            </tbody>
        </table>
    </div>
      <div class="col-lg-2">&nbsp;</div>
      <form id="rmform" method="POST" action="<?php echo RESOURCE ;?>/home/">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="cntr" value="<?php echo $activeController;?>" >
          <input type="hidden" name="actn" value="rmPost" >
      </form>
</div>

<script>
    
    $(document).ready(function(){
        $('#addTask').on('click', function(){
            // display add new task div
        });
        
        $('.editTask').on('click', function(){
            
        });
        
        $('.removeTask').on('click', function(){
            
        });
    });
</script>






