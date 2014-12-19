<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <link rel="icon"  type="image/png" href="<?php echo RESOURCE ;?>/img/logov128.png" />
         <title>CheckList APP</title>
        <link href="<?php echo RESOURCE ;?>/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo RESOURCE ;?>/css/Site.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo RESOURCE ;?>/css/custom.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo RESOURCE ;?>/js/jquery-1.11.2.min.js" type="text/javascript"></script>
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
    </ul>
    <form class="navbar-form navbar-left">
      <input type="text" class="form-control col-lg-8" placeholder="Search">
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo RESOURCE ;?>/login/index">Login</a></li>
      <li class="dropdown">
        <a href="<?php echo RESOURCE ;?>/users/" class="dropdown-toggle" data-toggle="dropdown">Users Manager <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo RESOURCE ;?>/users/">View All Users</a></li>
          <li><a href="<?php echo RESOURCE ;?>/users/add.php">Add New User</a></li>
        </ul>
      </li>
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
