<?php
$file_path = 'rename-before.txt';
if (file_exists($file_path)) {
    $file = file_get_contents($file_path);
} else {
    $file = '';
}



$file_path2 = 'rename-after.txt';
if (file_exists($file_path)) {
    $file2 = file_get_contents($file_path2);
} else {
    $file2 = '';
}


rename($file,$file2)
?>