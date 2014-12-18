<h3> Checklist</h3>


<div class="row">
   
    <div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
     <?php foreach ($data['checklists'] as $clist)  { ?>
       <tr>
           <td><?php echo $clist->ChecklistName; ?></td>
           <td><a href="<?php echo RESOURCE; ?>/checklist/view/<?php echo $clist->ChecklistID ?>" >view</a>&nbsp;
           <a href="<?php echo RESOURCE; ?>/checklist/update/<?php echo $clist->ChecklistID ?>" >update</a>&nbsp;
           <a href="<?php echo RESOURCE; ?>/checklist/delete/<?php echo $clist->ChecklistID ?>" >delete</a></td>
       </tr>
     <?php } ?>
            </tbody>
        </table>
    </div>
      <div class="col-lg-3">&nbsp;</div>
</div>