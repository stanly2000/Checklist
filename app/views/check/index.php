<h3>Checklist</h3>

<div class="row">

	<div class="col-lg-2">&nbsp;</div>
	<div class="col-lg-8">

		<table class="table">
			<thead>
				<tr>
					<th>Checklist Name</th>
					<th>Task Name</th>
					<th>Property Name</th>
					<th>Property Value</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
     <?php foreach ($data['checklists'] as $clist)  { ?>
       <tr id="details_<?php echo $clist->AssignID; ?>">
					<td>
						<button id="btnToggleChecklist_<?php echo $clist->AssignID; ?>" class="toggleChlist fa fa-plus fa-2x"></button>
           <?php echo $clist->ChecklistName; ?></td>
					<td colspan="4"></td>
				</tr>
     <?php } ?>
            </tbody>
		</table>
	</div>
	<div class="col-lg-2">&nbsp;</div>
	<form id="rmform" method="POST"
		action="<?php echo RESOURCE ;?>/home/index.php">
		<input type="hidden" name="id" id="id" value=""> <input type="hidden"
			name="cntr" value="<?php echo $activeController;?>"> <input
			type="hidden" name="actn" value="rmPost">
	</form>
</div>
<script>
$(document).ready(function () {

	$(document).on('click', '.toggleCheck', function () {
		var tmp = $(this).attr('id').split('_');
	
		updateTask(tmp[1],tmp[2]);
		toogleClassIcons($(this).attr('id'),'fa-check-square-o','fa-square-o');
	});

	
    $('.toggleChlist').on('click', function () {
    	var rowID = $(this).closest("tr");
   	 if ($(this).hasClass('fa-plus')) {	
    	loadTasks(rowID);
   	 }
   	 else{
    		clearTasks(rowID); 
   	 }
   	 toogleClassIcons($(this).attr('id'),'fa-plus','fa-minus');
    });

   
});

function updateTask(taskID,assignID){
	
    var tmpData = {'taskID':taskID, 'assignID': assignID};
    $.ajax({
        url : _POST_URL,
        type: "POST",
        data : { cntr: "check", actn:"updateTaskPost" ,jsonData: JSON.stringify(tmpData)},
        success: function(data, textStatus, jqXHR)
        {
            res = JSON.parse(data);
            console.log(res);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {}
    });
}

function clearTasks(rowID){
	var tmp = $(rowID).attr('id').split('_');
    var checklistID = tmp[1];  
	$('.taskTR').each(function(index, value){
	    // console.log($(this).attr('id'));
	   
	    tmp = $(this).attr('id').split('_');
	    if (checklistID == tmp[0]){
		    $('#' + $(this).attr('id')).empty();
	    }
	});
}
function loadTasks(rowID){
	
	var tmp = $(rowID).attr('id').split('_');
    var assignID = tmp[1];      

    var tmpData = {'assignID':assignID};
    $.ajax({
        url : _POST_URL,
        type: "POST",
        data : { cntr: "check", actn:"getTasks" ,jsonData: JSON.stringify(tmpData)},
        success: function(data, textStatus, jqXHR)
        {
            res = JSON.parse(data);

            res.forEach(function(entry) {
                console.log(entry);
               // console.log(entry['ChecklistID']);
                propVal = '';

                if (entry['StatusID'] == 3)
                	checkStyle = "fa-check-square-o";
                else
                checkStyle = "fa-square-o";
               
                var newTaskTrID = entry['ChecklistID'] + '_' + entry['TaskID'];
                var newTaskTr = '<tr id="'+newTaskTrID+'" class="taskTR"><td>&nbsp;</td><td>' + entry['TaskName'] + '</td>'; 
                if (entry['PropertyName'] != null){
               	 if (entry['PropertyAttribute'] == ''){
                     propVal = entry['PropertyValue'];
                 }
                 else{
                     propVal = entry['PropertyAttribute'];
                 }
                    
             ///   	newTaskTr += '<td>' + entry['PropertyName'] + '</td>' + 
             ///   '<td><input type="text" id="propVal_' + entry['TaskID'] + '" value="' + propVal + '" ></td>';

                	newTaskTr += '<td>' + entry['PropertyName'] + '</td>' + 
                    '<td>' + propVal + '</td>';
                }
                else{
                	newTaskTr += '<td></td><td></td>';
                }
                newTaskTr += '<td><button id="btnCheck_' + entry['TaskID'] + '_' + assignID +  '" class="toggleCheck fa ' + checkStyle + ' fa-2x" ></button></td><tr>';

                $(rowID).after(newTaskTr);
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {}
    });
}
function toogleClassIcons(id, class1, class2) {

    if ($('#' + id).hasClass(class1)) {
        $('#' + id).removeClass(class1);
        $('#' + id).addClass(class2);
    }
    else {
        $('#' + id).removeClass(class2);
        $('#' + id).addClass(class1);
    }
}

</script>