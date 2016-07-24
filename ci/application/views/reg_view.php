<!DOCTYPE html>
<html lang = "en">

   <head>
      <meta charset = "utf-8">
      <title>Students Example</title>
   </head>

   <body>


      <table border = "1">
         <?php
            $i = 1;
            echo "<tr>";
            echo "<td>Sr#</td>";
            echo "<td>Roll No.</td>";
            echo "<td>Name</td>";
            echo "<td>Edit</td>";
            echo "<td>Delete</td>";
            echo "<tr>";

            foreach($records as $r) {
               echo "<tr>";
               echo "<td>".$i++."</td>"; 
               echo "<td>".$r->name."</td>";



            }
         ?>
      </table>

   </body>

</html>
