
<h3> Users !</h3>
 <table>
     <th>Checklist Title</th>
     <th>Actions</th>
 <?php

foreach ($data['checklists'] as $clist) {   
    ?>
      
       <tr>
           <td><?php echo $clist->ChecklistName; ?></td>
           <td></td>
 
       </tr>
     <?php  }
       ?>
       </table>

