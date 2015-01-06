<h3> Checklist</h3>


<div class="row">
   
    <div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    
                </tr>
            </thead>
            <tbody>
     <?php foreach ($data['checklists'] as $clist)  { ?>
       <tr>
           <td><i class="fa fa-bicycle"></i><span class="glyphicon glyphicon-plus"></span>
           <button id="details_<?php echo $clist->ChecklistID; ?>" class="toggleTask fa fa-chevron-down"></button>
           <?php echo $clist->ChecklistName; ?></td>           
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