<html>
    <head>
        <title>Create Group</title>
    </head>
    <body>
        <form method="post" action="<?php echo RESOURCE ;?>/group/CreateGroup">
            Name: <input type="text" name="groupname" id="groupname" />
            <input type="submit" value="Back" onclick="document.location.href='http://localhost/checklist/public/group'" />
            <input type="submit" value="Add" />
        </form>
    </body>
</html>
