<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <link rel="icon"  type="image/png" href="<?php echo RESOURCE ;?>/img/logov128.png" />
         <title>CheckList APP</title>
        <link href="<?php echo RESOURCE ;?>/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    </head>
   
    <body>
<div class="navbar navbar-inverse">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Brand</a>
  </div>
  <div class="navbar-collapse collapse navbar-inverse-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Active</a></li>
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li class="dropdown-header">Dropdown header</li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    <form class="navbar-form navbar-left">
      <input type="text" class="form-control col-lg-8" placeholder="Search">
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="../views/Login/index.php">Login</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
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
