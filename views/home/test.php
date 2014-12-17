<h3> Users</h3>
 <table>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Email </th>
     <th>Security Level</th>
 <?php

foreach ($data['users'] as $user) {   
    ?>
      
       <tr>
           <td><?php echo $user->FirstName; ?></td>
           <td><?php echo $user->LastName; ?></td>
           <td><?php echo $user->Email; ?></td>
           <td><?php echo $user->SecurityLevel; ?></td>
 
       </tr>
     <?php  }
       ?>
       </table>
       

