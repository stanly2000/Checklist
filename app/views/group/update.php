<html>
    <head>
        <title>Group Update</title>
    </head>
    <body>
        <form method="post" action="<?php echo RESOURCE ;?>/group/UpdateGroup" class="form-horizontal">
          <table>
            <?php foreach($data['update'] as $g) { ?>
              <input type="hidden" value="<?php echo $g->GroupID ?>" id="GroupID" name="GroupID"/>
            <div class="form-group">
            <label for="GroupName" class="col-lg-2 control-label">Group Name</label>
             <div class="col-lg-3">
            <input type="text" class="form-control" type="text" value="<?php echo $g->GroupName ?>" id="UGName" name="UGName">
             </div>
            </div>
            <?php } ?>
        </table>
            <input type="button" name="UGbtn" value="Back" onclick="document.location.href = '<?php echo RESOURCE; ?>/group/index'" class="btn btn-success"/>
            <input type="submit" value="Update" class="btn btn-success" />
        </form>
    </body>
</html>
