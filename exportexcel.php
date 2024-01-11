<?php


function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}
function exportexcel($data){
    $fileName = "cients_data-" . date('Ymd') . ".csv"; 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    header("Content-Type: text/csv");

    foreach($data as $row) { 
        array_walk($row, 'filterData'); 
        echo implode(",", array_values($row)) . "\n"; 
    } 
    
    exit;
}

?>