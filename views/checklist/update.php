
<div class="row">
  <div class="col-lg-3">&nbsp;</div>
  <div class="col-lg-6">
      <form method="POST" action="<?php echo RESOURCE ;?>/home/index.php">
          <input type="hidden" name="cntr" value="<?php echo $activeController;?>" >
          <input type="hidden" name="actn" value="<?php echo $callbackMethod;?>" >
          <input type="hidden" name="id" value="<?php echo $data['checklist']->ChecklistID;?>" >
          
  <div class="form-group">
    <label for="title"></label>
    <input type="text" class="form-control" id="title" name="title" value="<?php echo $data['checklist']->ChecklistName ?>">
  </div>

  <button type="submit" class="btn btn-default">Update</button>
  &nbsp;&nbsp;&nbsp;<button type="button"  class="btn btn-default btnCancel">Cancel</button>
</form>
  </div>      
  <div class="col-lg-3">&nbsp;</div>
        </div>
        
