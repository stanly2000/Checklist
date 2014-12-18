<html>
<head>
  <title>Checklists</title>
  <style type="text/css">
    h1 {color:aquamarine; font-size:24pt; text-align:center;
        font-family:arial,sans-serif}
    .menu {color:aquamarine; font-size:12pt; text-align:center;
           font-family:arial,sans-serif; font-weight:bold}
    td {background:darkgrey}
    p {color: darkgrey; font-size:12pt; text-align:justify;
       font-family:arial,sans-serif}
    p.foot {color:aquamarine; font-size:9pt; text-align:center;
            font-family:arial,sans-serif; font-weight:bold}
    a:link,a:visited,a:active {color:aquamarine}
  </style>
</head>
<body>
    
    

  <!-- page header -->
  <table width="100%" cellpadding="12" cellspacing="0" border="0" bgcolor="black">
  <tr bgcolor="black">
      <td align="left"><img src="checklist.jpg" alt="Checklist logo" height=70 width=70></td>
    <td>
        <h1>Checklists</h1>
    </td>
    <td align="right"><img src="checklist.jpg" alt="Checklist logo" height=70 width=70></td>
  </tr>
  </table>

  <!-- menu -->
   <table width="100%" bgcolor="black" cellpadding="4" cellspacing="4">
  <tr >
    <td width="20%">
       <a href="home.php"><span class="menu">Home</span></a></td>
    <td width="20%">
      <a href="checklists.php"><span class="menu">Checklists</span></a></td>
    <td width="20%">
      <a href="home.php"><span class="menu">Spare</span></a></td>
    <td width="20%">
      <a href="users.php"><span class="menu">Users Manager</span></a></td>
    <td width="20%">
      <a href="login.php"><span class="menu">Login</span></a></td>
  </tr>
  </table>
  
  <!-- page content -->
 <form name="input" method="post" action="register.php" >
  <table align="left">
      
       <tr>
     <td>First Name:</td>
     <td><input type="text" name="FirstName" size="30" maxlength="100"/></td></tr>
      
        <tr>
     <td>Last Name:</td>
     <td><input type="text" name="LastName" size="30" maxlength="100"/></td></tr>
       
   <tr>
     <td>Email Address:</td>
     <td><input type="text" name="Email" size="30" maxlength="100"/></td></tr>
   
   <tr>
     <td>Password <br />(between 6 and 16 chars):</td>
     <td valign="top"><input type="password" name="password"
         size="16" maxlength="16"/></td></tr>
   <tr>
     <td>Confirm password:</td>
     <td><input type="password" name="passwd2" size="16" maxlength="16"/></td></tr>
   <tr>
     <td colspan="2 align="center">
     <input type="submit" value="Register"></td>
     <td colspan="2"></td></tr> 
 </table>
 </form>
  
     <!-- page footer -->
  <table width="100%" bgcolor="black" cellpadding="12" border="0">
  <tr>
    <td>
      <p class="foot">&copy; Checklist </p>
      <p class="foot">Please see our <a href="legal.php">Legal information page</a></p>
    </td>
  </tr>
  </table>
</body>
</html>