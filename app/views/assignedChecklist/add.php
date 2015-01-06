<h4>Assign Checklists to Groups</h4>
<div class="row">
  <div class="col-lg-3">&nbsp;</div>
  <div class="col-lg-6">
      <form method="POST" action="<?php echo RESOURCE ;?>/home/">
          <input type="hidden" name="cntr" value="<?php echo $activeController;?>" >
          <input type="hidden" name="actn" value="<?php echo $callbackMethod;?>" >
          <input type="hidden" name="checklistid" value="<?php echo $data['checklist']->ChecklistID;?>" >
          <input type="hidden" name="id" value="<?php echo $data['group']->GroupID;?>" >
          
  <div class="form-group">
      
      <table  style=" line-height:80px;">
           
          <tr>
              <td>
    <label for="checklistName">Select Checklist:</label>
    &nbsp; &nbsp;
    </td>
    <td>
    <select class="form-control" id="checklistName" name="checklistName"
            value="<?php echo $data['checklist']->ChecklistName ?>">
               
      </select>
        </td>
      </tr>
      
      <tr>
          <td>
                <label for="groupName">Select Group:</label>
    
          </td>
          <td>
           <select class="form-control" id="groupName" name="groupName" value="">
        <option value="1">aaa</option>
          <option value="2">bbb</option>
          <option value="3">ccc</option>         
      </select>
        </td>
      </tr>
      
    </table>
  </div>

  <button type="submit" class="btn btn-default">Assign</button>
  &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default btnCancel">Cancel</button>
</form>
  </div>      
  <div class="col-lg-3">&nbsp;</div>
</div>
