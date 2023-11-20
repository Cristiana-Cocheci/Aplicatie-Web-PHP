<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="neverlanes.css" type="text/css">

   <title>neverlanes</title>
   <meta charset="utf-8">
   <meta name="autor" content="cristi">
   <meta name="description" content="pagina web?">
   <meta name="keywords" content="neverlanes">
   <!--<link rel="icon" type="image/x-icon" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\Spongrio.webp">-->

   <!--<link rel="stylesheet" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\style.css" type="text/css">-->
</head>

<body>
   <div class="header">
      <h1>
         NEVERLANES
      </h1>
   </div>
   <FORM method="POST" action="show_route.php">
      <table>
         <tr><td>Check an available route!</td></tr>
         <tr>
            <td>
               <select name="route">
                  <?php
                  $link = mysqli_connect("mysql-neverlanes.alwaysdata.net", "336043", "Elijah.R.Daneel", "neverlanes_database");

                  if (!$link) {
                     echo "Error: Unable to connect to MySQL.";
                     exit;
                  }

                  $query = "SELECT * FROM ROUTES";

                  echo $query;

                  foreach ($link->query($query) as $row) {
                     print '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                 }
                 
                  mysqli_close($link);
                  ?>

                  <option SELECTED VALUE="">Select...</option>
               </select>
            </td>
         </tr>
         <tr>
            <td><INPUT TYPE="submit" VALUE="Click here to see selected route."></td>
         </tr>
      </table>
   </FORM>

</body>

</html>
