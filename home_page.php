<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="home_page.css" type="text/css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
   <script type="text/javascript" src="harta.js"></script>

   <title>neverlanes</title>
   <meta charset="utf-8">
   <meta name="autor" content="cristi">
   <meta name="description" content="pagina web?">
   <meta name="keywords" content="neverlanes">
   <!--<link rel="icon" type="image/x-icon" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\Spongrio.webp">-->

   <!--<link rel="stylesheet" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\style.css" type="text/css">-->
</head>

<body>
    <div class="coloana" id="coloana1"><img src="coloana.png" alt="greek column"></div>
    <div class="pagina">
        <div class="header">
            <h1>
                NEVERLANES
            </h1>
        </div>
   <?php require "header.php"; ?>
        <div class="menu">
            <ul>
                <li><a href="login.php">LOGIN</a></li>
                <li><a href="my_account_check.php">MY ACCOUNT</a></li>
            </ul>
        </div>
      
        <FORM method="POST" action="show_route.php">
            <table>
                
                <tr>
                    <td>
                    <select name="route">
                        <?php
                        $link = mysqli_connect("mysql-neverlanes.alwaysdata.net", "336043", "m.2a*Z!#mV!9vWH", "neverlanes_database");

                        if (!$link) {
                            echo "Error: Unable to connect to MySQL.";
                            exit;
                        }

                        $query = "SELECT * FROM ROUTES";

                        echo $query;

                        foreach ($link->query($query) as $row) {
                            print '<option value="' . $row['route_name'] . '">' . $row['route_name'] . '</option>';
                        }
                        
                        mysqli_close($link);
                        ?>

                        <option SELECTED VALUE="">Choose a route!</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><INPUT TYPE="submit" VALUE="Check it out!"></td>
                </tr>
            </table>
        </FORM>
        <div class="harta" id="harta">
        <!--<canvas id="canvmap" width="300" height="300"></canvas>-->
                    </div>
    </div>
   <div class="coloana" id="coloana2">
    <img src="coloana.png" alt="greek column">
   </div>
</body>

</html>
