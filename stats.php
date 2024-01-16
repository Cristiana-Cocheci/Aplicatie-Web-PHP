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

if(file_exists($fimg)) echo '<img src="'. $fimg .'" />';
else echo 'Unable to create: '. $fimg;

/*
########### histograma
$sql2 = "SELECT job_id, count(employee_id) as angajati from employees 
where job_id is not null GROUP by job_id having count(employee_id)>0;";
$result2 = $conn->query($sql2);
$num_results2 = $result2->num_rows;
$joburi2 = array();
$angajati2 = array();
for ($i=0; $i <$num_results2; $i++) {
   $row = $result2->fetch_assoc();
   array_push($joburi2, $row["job_id"].' ');
   array_push($angajati2,intval($row["angajati"]));
   echo 'Job: '.$row["job_id"]."   ".$row["angajati"].'# ';
}

require 'jpgraph/src/jpgraph_bar.php';


$fimg2 ='jpgraph-bars.png';
$graph = new Graph(1300,600,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->xaxis->SetTickLabels($joburi2);
#$graph->xaxis->SetTextLabelInterval(10);
$bplot = new BarPlot($angajati2);
$graph->Add($bplot);




$graph->title->Set("Bar Plots");

$graph->SetMargin(40,80,40,40);
$graph->legend->Pos(0.05,0.5, 'right', 'center');
$graph->legend->SetColumns(1);

// Display the graph
$graph->Stroke($fimg2);

if(file_exists($fimg2)) echo '<img src="'. $fimg2 .'" />';
else echo 'Unable to create: '. $fimg2;

############ top 3 culori din logo png

*/