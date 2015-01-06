<html>
    <head>
        <title>User Delete?</title>
    </head>
    <body>
  <div class="panel panel-success lg-5">
  <div class="panel-heading">
    <h3 class="panel-title"></h3>
  </div>
  <div class="panel-body">
        <form method="post" action="<?php echo RESOURCE ;?>/user/delete">
            <table>

    <?PHP foreach($data['delete'] as $d) { ?>
                <tr>
                    <td>
                        ID:&nbsp;
                    </td>
                    <td>
                        <?PHP echo $d->UserID  ?>
                        <input type="hidden" value="<?PHP echo $d->UserID ?>" name="UserID" id="UserID" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Group Name: &nbsp;
                    </td>
                    <td>
                        <?PHP echo $d->GroupName ?>
                    </td>
                <?PHP } ?>
            </table>
            <input type="button" value="Back" onclick="document.location.href='<?php echo RESOURCE; ?>/user/index'" class="btn btn-success"/>
            <input type="submit" value="Delete" class="btn btn-success" />
  </div>
</div>
                
        </form>
    </body>
</html>