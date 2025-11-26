<?php 

// $my_file=fopen("ds.txt","w");

// fclose($my_file);

// $my_file=fopen("dss.txt","r");

$file=fopen("example.txt","r");

while(!feof($file)){
    echo fgets($file) . "<br>";
}

fclose($file);


$h=fopen("data.txt","w+");

frwite($h, 'Text test 1');

$handle=fopen('data.txt', 'a+');
fwrite($handle, "Add more lines to the file");
fclose($handle);
?>