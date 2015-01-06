<hmlt>
    <head>
        <title>View Groups</title>
    </head>
    <body>
<div class="panel panel-success">
  <div class="panel-heading">
      <h3 class="panel-title"><?PHP echo $data['view'][0]->GroupName ?></h3>
      <input type="hidden" value="<?PHP echo $data['view'][0]->GroupID ?>" name="groupid" id="groupid" />
  </div>
  <div class="panel-body">
      <form method="post" action="<?php echo RESOURCE ;?>/group/AddUserToGroup">
      </form>
      <table class="table table-striped table-hover" >
          <thead>
              <tr class="success" >
                  <th>
                      User ID
                  </th>
                  <th>
                      First Name
                  </th>
                  <th>
                      Last Name
                  </th>
                  <th>
                      Email
                  </th>
                  <th>
                      Security Level
                  </th>
              </tr>
          </thead>
          <tbody>
              <?php foreach($data['view'] as $v) { ?>
              <tr>
                  <td>
                      <?PHP echo $v->UserID ?>
                  </td>
                  <td>
                      <?PHP echo $v->FirstName ?>
                  </td>
                  <td>
                      <?PHP echo $v->LastName ?>
                  </td>
                  <td>
                      <?PHP echo $v->Email ?>
                  </td>
                  <td>
                      <?PHP echo $v->SecurityLevel ?>
                  </td>
              </tr>
              <?PHP } ?>
          </tbody>
      </table>
      <input type="button" onclick="document.location.href='<?php echo RESOURCE; ?>/group/index'" value="Back"/>
  </div>
</div>
    </body>
</hmlt>
