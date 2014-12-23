<html>
    <head>
        <title>Group Update</title>
    </head>
    <body>
        <form method="post" action="<?php echo RESOURCE ;?>/group/UpdateGroup">
          <table>
            <?php foreach($data['update'] as $g) { ?>
            <tr>
                <td>ID: </td>
                <td>
                    <?php echo $g->GroupID ?>
                </td>
            </tr>
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
            <input type="submit" name="UGbtn" />
            <input type="submit" value="Update" />
        </form>
    </body>
</html>
