<?php 

define( 'FILE_DIR', 'report/malaysia' );

function listFiles( $date, $reportType, $json = false ) {

    $dirFiles = array_diff(scandir(FILE_DIR), array('..', '.'));
    $date = DateTime::createFromFormat( 'd-m-Y', $date, new DateTimeZone( '+0800' ) );
    $selectedFiles = array();
    $year = $date->format( 'y' );
    $month = $date->format( 'm' );
    $date = $date->format( 'd' );

    foreach( $dirFiles as $file ) {
        if( preg_match('/.*('.$reportType.')('.$year.')('.$month.')('.$date.')(\d{4})\.csv/',$file,$matches) ) {
            array_push( $selectedFiles, $file );
        }
    }

    if( $json ) {
        return json_encode($selectedFiles);
    }

    return $selectedFiles;
}

echo "<pre>";
$date = '22-09-2017';
$reportType = 'D';
$result = listFiles( $date, $reportType );

print_r($result);
?>