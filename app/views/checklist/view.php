<?php
//echo "<pre>";
//print_r($data['checklist']);
//echo "</pre>";
?>
<div class="row">
   
    <div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-8">
        <table class="table">
            <thead>
                <tr>
                    <th>Task Name</th>

                    <th>Task Property (optional)</th>
                    <th>Task Property Value (optional)</th>
                    <th >Actions &nbsp;&nbsp;&nbsp;<a class="font20" id="btnAddTask" href="#">Add New </a></th>
                </tr>
            </thead>
            <tbody>
                <tr id="trNewEdit" class="unseen">
                    <input type="hidden" name="taskIdEdit" id="taskIdEdit">
                    <td id="tName"><input type="text" id="txtName" ></td>
                    
                    <td >
                       <input type="text" id="txtOptName" >
                    </td>
                    <td >
                       <input type="text" id="txtOptValue" >
                    </td>
                    <td id="tActions" style="white-space: nowrap;"><button id="btnSave" class="btn btn-primary" >Save</button>&nbsp;&nbsp;&nbsp;
                            <button id="btnCancelEdit" class="btn btn-primary" >Cancel</button></td>
                </tr>
     <?php foreach ($data['checklist']->Tasks as $task)  { ?>
       <tr id="trTask_<?php echo $task->TaskID; ?>">
           <td class="tName"><?php echo $task->TaskName; ?></td>
           <td class="tPropName"><?php echo $task->PropertyName; ?></td>
           <td class="tPropVal"><?php  if ($task->TaskName == ''){ echo $task->PropertyAttribute;} else { echo $task->PropertyValue; } ?></td>
           <td>
           <a href="<?php echo RESOURCE; ?>/checklist/view/<?php echo $task->TaskID ?>" >view</a>&nbsp;
           <a id="uplink_<?php echo $task->TaskID ?>" class="editTask" href="#" >update</a>&nbsp;
           <a id="dlink_<?php echo $task->TaskID ?>" href="#" class='removeTask' >delete</a>

       </tr>
     <?php } ?>
            </tbody>
        </table>
    </div>
      <div class="col-lg-2">&nbsp;</div>
      <form id="rmform" method="POST" action="<?php echo RESOURCE ;?>/home/">
          <input type="hidden" name="jsonVals" id="jsonVals" value="">
          <input type="hidden" name="cntr" value="<?php echo $activeController;?>" >
          <input type="hidden" name="actn" value="rmPost" >
      </form>
</div>

<script>

    $(document).ready(function(){
        $('#btnAddTask').on('click', function(){
            // display add new task div
            $('#trNewEdit').removeClass("unseen");
            hideErrorMessageBoxes();
        });
        
        $(document).on('click', '.editTask', function () {
        	hideErrorMessageBoxes();
        	
            tmp = $(this).attr('id').split('_');
        	
             taskID = tmp[1];

             var currTR = $('#trTask_' + taskID);

             /* fill the edit form with selected task values */           
             $('#txtName').val($(currTR).find("td.tName").html().trim());
             $('#txtOptName').val($(currTR).find("td.tPropName").html().trim());
             $('#txtOptValue').val($(currTR).find("td.tPropVal").html().trim());
             $('#taskIdEdit').val(taskID);
             $('#trNewEdit').removeClass("unseen");

            
        });
        $(document).on('click', '.removeTask', function () {
        //$('.removeTask').on('click', function(){
            // promt yes /no?
            tmp = $(this).attr('id').split('_');
             idToDel = tmp[1];
            $.ajax({
                url : _POST_URL,
                type: "POST",
                data : { cntr: "checklist", actn:"removeTaskPost" ,taskID: idToDel},
                success: function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    res = JSON.parse(data);
                    if (res['actionCompleted'] == true){
                    var TrToRemove = 'trTask_' + idToDel;
                    $('#' + TrToRemove ).empty();
                    displayMessage(res['afterActionMessage']);
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {}
            });
            
        });
        
        $('#btnSave').on('click', function(){
            var TaskID = -1;
            if ($('#taskIdEdit').val() > 0)
            	TaskID = $('#taskIdEdit').val();

               var tmpData = {
                "TaskID": TaskID,
                "TaskName": $('#txtName').val(),
                "ChecklistID": <?php echo $data['checklist']->ChecklistID; ?>,
                "OptName": $('#txtOptName').val(),
                "OptValue": $('#txtOptValue').val()
            };

               console.log(tmpData);
            
            $.ajax({
                    url : _POST_URL,
                    type: "POST",
                    data : { cntr: "checklist", actn:"addTaskPost" ,jsonData: JSON.stringify(tmpData)},
                    success: function(data, textStatus, jqXHR)
                    {
                        res = JSON.parse(data);
                        var newID = res['id'];
                       if ( TaskID == -1){
                        trID = 'dlink_' + newID;
                        optParams = '';
                        if ($('#txtOptName').val() != ''){
                            optParams = $('#txtOptName').val()+ ' : ' + $('#txtOptValue').val();
                        }
                        buttonsTD = '<a href="' + _PATH_ + '/checklist/view/' + newID + '" >view</a>&nbsp&nbsp' +
                                    '<a class="" href="' + _PATH_ + '/checklist/update/' + newID + '" >update</a>&nbsp&nbsp;' +
                                    '<a id="' + trID + '" href="#" class="removeTask" >delete</a>' ;
                            
                        newAdded = '<tr id="trTask_' + newID + '"><td>' + $('#txtName').val() + '</td><td>' + $('#txtOptName').val() + '</td><td>' + $('#txtOptValue').val() + '</td><td>' + buttonsTD + '</td></tr>';
                        
                         $("tr:last").after(newAdded);
                       }
                       else{
                    	   var currTR = $('#trTask_' + taskID);  
                    	   $(currTR).find("td.tName").html($('#txtName').val());
                    	   $(currTR).find("td.tPropName").html($('#txtOptName').val());
                    	   $(currTR).find("td.tPropVal").html($('#txtOptValue').val());

                    	   $(currTR).removeClass("unseen");
                       }
                         
                         clearEditForm();
                        $('#trNewEdit').addClass("unseen");
                        displayMessage(res['afterActionMessage']);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {}
                });

        });
        
        $('#btnCancelEdit').on('click', function(){
            clearEditForm();
             $('#trNewEdit').addClass("unseen");
             hideErrorMessageBoxes();
        });
    });
    
    function clearEditForm(){
        $('#txtName').val('');
        $('#txtOptName').val('');
        $('#txtOptValue').val('');
    }
    
    function displayMessage(message){
        $('#messageBoxContainer').removeClass("unseen");
        $('.afterActionMessageBox').html(message);
    }
    function displayErrors(errors){
        $('#errorBoxContainer').removeClass("unseen");
        for (error in errors) {
        text +='<li>' + errors[error] + '</li>';
        $('.validationErrorsBox').html('<ul>' + message + '</ul>');
}
    }
    function hideErrorBox(){
        $('#errorBoxContainer').addClass("unseen");
    }
    function hideMessageBox(){
        $('#messageBoxContainer').addClass("unseen");
    }
    function hideErrorMessageBoxes(){
        $('#messageBoxContainer').addClass("unseen");
        $('#errorBoxContainer').addClass("unseen");
    }
</script>






