<?php 

define( 'FILE_DIR', '/var/www/report/malaysia' );

function listFiles( $date, $reportType, $json = false ) {

    $dirFiles = array_diff(scandir(FILE_DIR), array('..', '.'));
    $date = DateTime::createFromFormat( 'd-m-Y', $date, new DateTimeZone( '+0800' ) );
    $selectedFiles = array();
    $year = $date->format( 'y' );
    $month = $date->format( 'm' );
    $date = $date->format( 'd' );

	$selectedFiles = preg_grep ('/.*('.$reportType.')('.$year.')('.$month.')('.$date.')(\d{4})\.csv/', $dirFiles);

    if( $json ) {
        return json_encode($selectedFiles);
    }

    return $selectedFiles;
}

$result = listFiles( '22-09-2017', 'D' );
echo "<pre>";
print_r($result);
?>