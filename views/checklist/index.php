<h3> Checklist</h3>


<div class="row">
   
    <div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions &nbsp;&nbsp;&nbsp;<a href="<?php echo RESOURCE; ?>/checklist/add">Add New </a></th>
                </tr>
            </thead>
            <tbody>
     <?php foreach ($data['checklists'] as $clist)  { ?>
       <tr>
           <td><?php echo $clist->ChecklistName; ?></td>
           <td><a href="<?php echo RESOURCE; ?>/checklist/view/<?php echo $clist->ChecklistID ?>" >view</a>&nbsp;
           <a href="<?php echo RESOURCE; ?>/checklist/update/<?php echo $clist->ChecklistID ?>" >update</a>&nbsp;
           <a href="#" class='delLink' >delete</a></td>
       </tr>
     <?php } ?>
            </tbody>
        </table>
    </div>
      <div class="col-lg-3">&nbsp;</div>
      <form method="POST" action="<?php echo RESOURCE ;?>/home/">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="cntr" value="<?php echo $activeController;?>" >
          <input type="hidden" name="actn" value="rmPost" >
      </form>
</div>

