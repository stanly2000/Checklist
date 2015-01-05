
<hmlt>
    <head>
        <title>View Groups</title>
        
        <?php
        foreach ($data['view'] as $row){
           // print_r($row);
            echo $row['GroupName'];
        }
        ?>
    <h4><?php echo $data['view'][0]->GroupName; ?></h4>
    </head>
    <body>
        <input type="button" onclick="document.location.href='<?php echo RESOURCE; ?>/group/index'" value="Back"/>
<div class="panel panel-info">
  <div class="panel-heading">
      <h3 class="panel-title"><?PHP $data['view']; print_r($data['view']);?></h3>
  </div>
  <div class="panel-body">
      <table>
      </table>
  </div>
</div>
    </body>
</hmlt>
