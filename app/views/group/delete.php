<html>
    <head>
        <title>Group Delete</title>
    </head>
    <body>
        <form method="post" action="<?php echo RESOURCE ;?>/group/DeleteGroup">
          <table>
            <?php foreach($data['update'] as $g) { ?>
              <tr>
                  <td>
                      ID:
                  </td>
                  <td>
                      <?PHP echo $g->GroupID ?>
                  </td>
              </tr>
            <tr>
                <td>
                    Group Name:
                </td>
                <td>
                    <?PHP echo $g->GroupName ?>
                </td>
            </tr>
            <?php } ?>
        </table>
            <input type="submit" name="UGbtn" value="Back" onclick="document.location.href = 'http://localhost/checklist/public/group'"/>
            <input type="submit" value="Delete" />
        </form>
    </body>
</html>