<?php 
$matchedFiles = preg_grep('/.*D170922(\d{4})\.csv/', array_diff(scandir('C:\\xampp714\\htdocs\\fashion\\takeaway\\report\\malaysia'), array('..', '.')));
echo "<pre>";
print_r($matchedFiles);
