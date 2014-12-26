<hmlt>
    <head>
        <title>View Groups</title>
    </head>
    <body>
        <table>
            <?php foreach ($data['view'] as $v) { ?>
            <tr>
                <td>
                    Group ID: 
                </td>
                <td>
                    <?php echo $v->GroupID; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Group Name:&nbsp; 
                </td>
                <td>
                    <?php echo $v->GroupName; ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <input type="button" onclick="document.location.href='<?php echo RESOURCE; ?>/group/index'" value="Back"/>
    </body>
</hmlt>
