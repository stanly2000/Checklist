<html>
    <head>
        <meta charset="UTF-8">
        <title>Group Information</title>
    </head>
    <body>
<table class="table table-striped table-hover">
    <thead>
        <tr class="success">
            <th>Group ID</th>
            <th>Group Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
                <?php foreach($data['groups'] as $g) { ?>
                <tr >
                    <td><?php echo $g['GroupID']; ?></td>
                    <td><?php echo $g['GroupName']; ?></td>
                    <td>
                    <a href="<?php echo RESOURCE; ?>/group/view/<?php echo $g['GroupID'] ?>" >view</a> ||
                    <a href="<?php echo RESOURCE; ?>/group/update/<?php echo $g['GroupID'] ?>" >update</a> ||
                    <a href="<?php echo RESOURCE; ?>/group/delete/<?php echo $g['GroupID'] ?>" >delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
