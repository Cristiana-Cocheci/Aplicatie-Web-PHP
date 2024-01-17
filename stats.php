<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="stats.css" type="text/css">

   <title>neverlanes</title>
   <meta charset="utf-8">
   <meta name="autor" content="cristi">
   <meta name="description" content="pagina web?">
   <meta name="keywords" content="neverlanes">
   <!--<link rel="icon" type="image/x-icon" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\Spongrio.webp">-->

   <!--<link rel="stylesheet" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\style.css" type="text/css">-->
</head>

<body>
<div class="carousel">
   <ul class="slides">
<?php
//require 'includes/dbh.inc.php'; //conexiunea la baza de date
include_once "DBconnect.php";
require 'jpgraph/src/jpgraph.php';
require 'jpgraph/src/jpgraph_pie.php';
require 'jpgraph/src/jpgraph_pie3d.php';

$sql = "SELECT UPPER(role) as role, count(*) as useri from CLIENTS GROUP by role;";
$result = $link->query($sql);
$num_results = $result->num_rows;
$roluri = array();
$useri = array();
for ($i=0; $i <$num_results; $i++) {
   $row = $result->fetch_assoc();
   array_push($roluri,'Rol: '.$row["role"].' ');
   array_push($useri,intval($row["useri"]));
   //echo 'Dep'.$row["department_id"]."   ".$row["angajati"].'# ';
}

$fimg ='jpgraph-3d_pie_roluri.png';

$data =[40,60,25,34];

$graph = new PieGraph(960,660);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$graph->SetShadow();

$graph->title->Set('User type diagram');
$graph->title->SetFont(FF_FONT1,FS_BOLD);


$p1 = new PiePlot3D($useri);
$p1->ExplodeSlice(1);
$p1->SetCenter(0.5);
$p1->SetLegends($roluri);
$graph->legend->Pos(.088,0.9);

$graph->Add($p1);
$graph->Stroke($fimg);

if(file_exists($fimg)) echo '<img class="frame left-frame" src="'. $fimg .'" />';
else echo 'Unable to create: '. $fimg;


########### histograma
$sql2 = "SELECT action_type, count(*) as angajati from ACTION_LOGS
 GROUP by action_type;";
$result2 = $link->query($sql2);
$num_results2 = $result2->num_rows;
$joburi2 = array();
$angajati2 = array();
for ($i=0; $i <$num_results2; $i++) {
   $row = $result2->fetch_assoc();
   array_push($joburi2, $row["action_type"].' ');
   array_push($angajati2,intval($row["angajati"]));
   //echo 'Job: '.$row["job_id"]."   ".$row["angajati"].'# ';
}

require 'jpgraph/src/jpgraph_bar.php';


$fimg2 ='jpgraph-bars.png';
$graph = new Graph(1300,600,'auto');
$graph->SetScale("textlin");

$theme_class=new VividTheme;
$graph->SetTheme($theme_class);

$graph->xaxis->SetTickLabels($joburi2);
#$graph->xaxis->SetTextLabelInterval(10);
$bplot = new BarPlot($angajati2);
$graph->Add($bplot);




$graph->title->Set("Action types");

$graph->SetMargin(40,80,40,40);
$graph->legend->Pos(0.05,0.5, 'right', 'center');
$graph->legend->SetColumns(1);

// Display the graph
$graph->Stroke($fimg2);

if(file_exists($fimg2)){
echo '<img class="frame right-frame" src="'. $fimg2 .'" />';
} 
else echo 'Unable to create: '. $fimg2;


/******************************************** */

// Calculate the date one month ago from today

// Retrieve data for the last month
require 'jpgraph/src/jpgraph_line.php';
$query = "SELECT login_date, SUM(time_spent) AS total_time_spent FROM LOGS GROUP BY login_date";
$result = mysqli_query($link, $query);

$num_results2 = $result->num_rows;
$dates = array();
$times = array();
for ($i=0; $i <$num_results2; $i++) {
   $row = $result->fetch_assoc();
   array_push($dates, $row["login_date"].' ');
   array_push($times,floatval($row["total_time_spent"])/3600);
}

$fimg3 ='jpgraph-line.png';
$graph = new Graph(1300,600,'auto');
$graph->SetScale("textlin");

$theme_class=new VividTheme;
$graph->SetTheme($theme_class);

$graph->xaxis->SetTickLabels($dates);
#$graph->xaxis->SetTextLabelInterval(10);
$bplot = new LinePlot($times);
$graph->Add($bplot);




$graph->title->Set("Log durations");

$graph->SetMargin(40,80,40,40);
$graph->legend->Pos(0.05,0.5, 'right', 'center');
$graph->legend->SetColumns(1);

// Display the graph
$graph->Stroke($fimg3);

if(file_exists($fimg3)) echo '<img class="frame middle-frame" src="'. $fimg3 .'" />';
else echo 'Unable to create: '. $fimg3;


?>
</ul>
</div>

</body>
</html>

