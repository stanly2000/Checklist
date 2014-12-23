<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <link rel="icon"  type="image/png" href="<?php echo RESOURCE ;?>/img/logov128.png" />
         <title>CheckList APP</title>
        <link href="<?php echo RESOURCE ;?>/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo RESOURCE ;?>/css/Site.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo RESOURCE ;?>/css/custom.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo RESOURCE ;?>/js/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script>
            var _PATH_ = '<?php echo RESOURCE; ?>';
            var _POST_URL = "<?php echo RESOURCE; ?>/home/index.php";
        </script>
        
        <script type="text/javascript">
        $(document).ready(function(){
            var data = "<?php if(isset($_SESSION['SecurityLevel'])) echo $_SESSION['SecurityLevel'];else echo "-1"; ?>";
                $('#Loginbtn').hide();
                $('#Logoutbtn').hide();
                $('#UserManager').hide();
            if (data != -1) {
                $('#Loginbtn').hide();
                $('#Logoutbtn').show();
                if (data >= 2) {
                    $('#UserManager').show();
                }
                else{
                    $('#UserManager').hide();
                }
            }
            else{
                $('#Loginbtn').show();
                $('#Logoutbtn').hide();
            }
        });
        </script>
    </head>
    <body>
<div class="navbar navbar-inverse">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Checklist</a>
  </div>
  <div class="navbar-collapse collapse navbar-inverse-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="../public/">Home</a></li>
      <li class="dropdown">
        <a href="<?php echo RESOURCE ;?>/checklist" class="dropdown-toggle" data-toggle="dropdown">Checklists <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo RESOURCE ;?>/checklist/">View All Checklists</a></li>
          <li><a href="<?php echo RESOURCE ;?>/checklist/add.php">Add New Checklist</a></li>
          <li class="divider"></li>
        </ul>
      </li>
      <li class="active"><a href="<?php echo RESOURCE ;?>/task/">Tasks</a></li>
    </ul>
    <form class="navbar-form navbar-left">
      <input type="text" class="form-control col-lg-8" placeholder="Search">
    </form>
    <ul class="nav navbar-nav navbar-right">
        <?php 
        if(!empty($_SESSION['SecurityLevel'])){
        if ($_SESSION['SecurityLevel']!=-1) {
            ?>
        <li><a>Hello&nbsp;<?php echo $_SESSION['FirstName'];?>!</a></li>
        <li><a id="Logoutbtn" href="<?php echo RESOURCE ;?>/login/logout">Log out</a></li>
                <li id="UserManager" class="dropdown">
        <a href="<?php echo RESOURCE ;?>/user/index" class="dropdown-toggle" data-toggle="dropdown">Users Manager <b class="caret"></b></a>
      </li>
        <?php  }  
        }  ?>
        <li><a id="Loginbtn" href="<?php echo RESOURCE ;?>/login/index">Log in</a></li>
    </ul>
  </div>
</div>
        
        <div class="container body-content">
            
            <div class="row">  
                <div class="span6">  
                    <ul class="breadcrumb">  
                            <li>  
                            <a href="<?php echo RESOURCE ;?>/index.php">Home</a> <span class="divider"></span>  
                          </li> 
                          <li>  
                            <a href="<?php echo RESOURCE ;?>/<?php echo $activeController;?>"><?php echo $activeController;?></a> <span class="divider"></span>  
                          </li>  
                          <li>  
                            <?php  echo $activeControllerMethod;?> <span class="divider"></span>  
                          </li>  
                    </ul>  
                </div>  
            </div> 
       
            <?php  if (isset($_SESSION['validationErrors']) && count($_SESSION['validationErrors']) > 0){
                    $errorBoxCssClass = "";
                    }
                    else {
                        $errorBoxCssClass = "unseen";
                    }
             ?>
            
<div class="row <?php echo $errorBoxCssClass; ?>">
  <div class="col-lg-3">&nbsp;</div>
  <div class="col-lg-6 validationErrorsBox">
      <ul>
      <?php
          if (isset($_SESSION['validationErrors']) && count($_SESSION['validationErrors']) > 0){
          foreach ($_SESSION['validationErrors'] as $valError) {
              echo "<li>".$valError."</li>";
          }
          unset($_SESSION['validationErrors']);
          }
      ?>
      </ul>
  </div>
  <div class="col-lg-3">&nbsp;</div>
</div>
            
  
            <?php if (isset($_SESSION['afterActionMessage']) ) {
                    $messageBoxCssClass = "";
                    $message =  "<BR>".$_SESSION['afterActionMessage']."<BR>";
                    unset($_SESSION['afterActionMessage']);
            }
                    else {
                        $messageBoxCssClass = "unseen";
                        $message = "";
                    }
             ?>
            <div class="row <?php echo $messageBoxCssClass; ?>">
  <div class="col-lg-3">&nbsp;</div>
  <div class="col-lg-6 afterActionMessageBox">
      <?php echo $message; ?>
  </div>
  <div class="col-lg-3">&nbsp;</div>
</div>
            
