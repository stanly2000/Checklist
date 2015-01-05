<html>
    <head>
        <title>Group Update</title>
    </head>
    <body>
        <form method="post" action="<?php echo RESOURCE ;?>/group/UpdateGroup">
          <table>
            <?php foreach($data['update'] as $g) { ?>
              <input type="hidden" value="<?php echo $g->GroupID ?>" id="GroupID" name="GroupID"/>
            <tr>
                <td>
                    Group name:&nbsp;
                </td>
                <td>
                    <input type="text" value="<?php echo $g->GroupName ?>" id="UGName" name="UGName"/>
                </td>
            </tr>
            <?php } ?>
        </table>
            <input type="submit" name="UGbtn" value="Back" onclick="document.location.href = 'http://localhost/checklist/public/group'"/>
            <input type="submit" value="Update" />
        </form>
    </body>
</html>
