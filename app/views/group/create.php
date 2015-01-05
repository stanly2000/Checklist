<html>
    <head>
        <title>Create Group</title>
    </head>
    <body>
        <form method="post" action="<?php echo RESOURCE ;?>/group/CreateGroup" class="form-horizontal">
            <div class="form-group">
            <label for="Name" class="col-lg-2 control-label"> Group Name: </label>
             <div class="col-lg-3">
            <input type="text" class="form-control" input type="text" name="groupname" id="groupname">
             </div>
            </div>
            
            <input type="submit" value="Back" onclick="document.location.href='http://localhost/checklist/public/group'" class="btn btn-success" />
            <input type="submit" value="Add New Group" class="btn btn-success"/>
        </form>
    </body>
</html>
