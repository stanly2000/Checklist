  <!-- page content -->
<form action="<?php echo RESOURCE ;?>/register/register" method="post" role="form" class="form-horizontal">
   <input type="hidden" name="cntr" value="<?php echo $activeController;?>" >
          <input type="hidden" name="actn" value="<?php echo $callbackMethod;?>" >
         
    <fieldset>
    <legend>Register</legend>
            <hr />
        <div class="form-group">
            <label for="ProfilePic" class="col-lg-2 control-label">Profile Picture</label>
            <div class="col-md-10">
                <img id="profilepic" alt="" width="100" height="100" />
                <input type="file" name="ProfilePicture" onchange="readURL(this)"/>
            </div>
        </div>
        <div class="form-group">
            <label for="Email" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="Email" id="Email" placeholder="Email">
        </div>
        </div>
        <div class="form-group">
            <label for="FirstName" class="col-lg-2 control-label">First Name</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="FirstName">
        </div>
        </div>
        <div class="form-group">
            <label for="LastName" class="col-lg-2 control-label">Last Name</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="LastName" id="LastName" placeholder="LastName">
        </div>
        </div>
        <div class="form-group">
            <label for="Password" class="col-lg-2 control-label">Password</label>
        <div class="col-lg-10">
                <input type="password" name="Password" class="form-control" id="Password" placeholder="Password">
        </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="Create" class="btn btn-success" />
            </div>
        </div>
    </div>