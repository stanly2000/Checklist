
<div class="row">
   
    <div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-8">
        <table class="table">
            <thead>
                <tr>
                    <th>Task Name</th>
                   
                    <th>Task Properties</th>
                    <th >Actions &nbsp;&nbsp;&nbsp;<a class="font20" id="btnAddTask" href="#">Add New </a></th>
                </tr>
            </thead>
            <tbody>
                <tr id="trNewEdit" class="unseen">
                    <td id="tName"><input type="text" id="txtName" ></td>
                    
                    <td id="tOptions">
                        Attribute (optional):<input type="text" id="txtOptName" >&nbsp;<br><br>Value (optional): <input type="text" id="txtOptValue" >
                    </td>
                    <td id="tActions" style="white-space: nowrap;"><button id="btnSave" class="btn btn-primary" >Save</button>&nbsp;&nbsp;&nbsp;
                            <button id="btnCancelEdit" class="btn btn-primary" >Cancel</button></td>
                </tr>
     <?php foreach ($data['checklist']->Tasks as $task)  { ?>
       <tr id="trTask_<?php echo $task->TaskID; ?>">
           <td><?php echo $task->TaskName; ?></td>

           <td> ppp</td>
           <td>
           <a href="<?php echo RESOURCE; ?>/checklist/view/<?php echo $task->TaskID ?>" >view</a>&nbsp;
           <a class="editTask" href="<?php echo RESOURCE; ?>/checklist/update/<?php echo $task->TaskID ?>" >update</a>&nbsp;
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
        });
        
        $('.editTask').on('click', function(){
            
        });
        
        $('.removeTask').on('click', function(){
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
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {}
            });
            
        });
        
        $('#btnSave').on('click', function(){
               var tmpData = {
                "TaskID": -1,
                "TaskName": $('#txtName').val(),
                "ChecklistID": <?php echo $data['checklist']->ChecklistID; ?>,
                "OptName": $('#txtOptName').val(),
                "OptValue": $('#txtOptValue').val()
            };
            
            $.ajax({
                    url : _POST_URL,
                    type: "POST",
                    data : { cntr: "checklist", actn:"addTaskPost" ,jsonData: JSON.stringify(tmpData)},
                    success: function(data, textStatus, jqXHR)
                    {
                        res = JSON.parse(data);
                        var taskID = res['id'];
                       // alert(taskID);
                        trID = 'dlink_' + taskID;
                        optParams = '';
                        if ($('#txtOptName').val() != ''){
                            optParams = $('#txtOptName').val()+ ' : ' + $('#txtOptValue').val();
                        }
                        buttonsTD = '<a href="' + _PATH_ + '/checklist/view/' + taskID + '" >view</a>&nbsp' +
                                    '<a class="" href="' + _PATH_ + '/checklist/update/' + taskID + '" >update</a>&nbsp;' +
                                    '<a id="' + trID + '" href="#" class="removeTask" >delete</a>' ;
                            
                        newAdded = '<tr><td>' + $('#txtName').val() + '</td><td>' + optParams + '</td><td>' + buttonsTD + '</td></tr>';
                        
                         $("tr:last").after(newAdded);
                         
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
        });
    });
    
    function clearEditForm(){
        $('#txtName').val('');
        $('#txtOptName').val('');
        $('#txtOptValue').val('');
    }
    
    function displayMessage($message){
        $('#messageBoxContainer').removeClass("unseen");
        $('.afterActionMessageBox').html($message);
    }
    
    function displayError($error){
    }
</script>






