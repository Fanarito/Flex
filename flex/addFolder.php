
<?php
$file = '/home/gru/python/folders.txt';
// The new folder to add to the file
$folder = $_GET["folder"] . ":" . $_GET["accessgroup"] . "\n";
// Write the contents to the file,
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($file, $folder, FILE_APPEND | LOCK_EX);
?>
