<html>
    <head>
        <title>Group Delete?</title>
    </head>
    <body>
        <form method="post" action="<?php echo RESOURCE ;?>/group/DeleteGroup">
            <table>
                <?PHP foreach($data['delete'] as $d) { ?>
                <tr>
                    <td>
                        ID:&nbsp;
                    </td>
                    <td>
                        <?PHP echo $d->GroupID  ?>
                        <input type="hidden" value="<?PHP echo $d->GroupID ?>" name="GroupID" id="GroupID" />
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
            <input type="button" value="back" onclick="document.location.href='<?php echo RESOURCE; ?>/group/index'" />
            <input type="submit" value="Delete" />
        </form>
    </body>
</html>