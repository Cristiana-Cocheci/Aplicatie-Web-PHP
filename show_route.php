<?php
$servername = "mysql-neverlanes.alwaysdata.net";
$username = "336043";
$password = "Elijah.R.Daneel";
$dbname = "neverlanes_database";

$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    echo "Error: Unable to connect to MySQL.";
    exit;
}

if(count($_POST)>0) {
    if (isset($_POST['route'])) {
        $selectedRoute = $_POST['route'];
        $query = "SELECT * FROM ROUTES where name = '".$selectedRoute."';";
        $rez = $link->query($query);

        if (!$rez) {
            echo "Error executing query: " . $link->error;
            exit;
        }

        $row = $rez->fetch_assoc();
        echo "Selected route: " . $selectedRoute . ". Length of route: " . $row['length']."<br>";
        echo "Number of stops: ". $row['no_stops']."<br>";
        $route_id=$row['route_id'];

        $query2 = "SELECT * FROM STOPS where route_id = '".$route_id."' ORDER BY location_id;";
        foreach ($link->query($query2) as $row) {
            echo  $row['name']."<br>";
        }


    } else {
        echo "No route selected.";
    }
    
    exit();

}
mysqli_close($link);

?>

