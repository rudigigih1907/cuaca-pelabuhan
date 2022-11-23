<?php 
function waktu_UTC($tanggal)
{
    $utc_date = DateTime::createFromFormat(
        'Y-m-d H:i',
        $tanggal,
        new DateTimeZone('UTC')
    );

    $utc_date->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $utc = $utc_date->format('Y-m-d H:i');
    return $utc;
}
?>