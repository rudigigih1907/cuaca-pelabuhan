<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Cuaca <?= $cuaca->name ?>/<?= $cuaca->valid_from ?>-<?= $cuaca->valid_to ?> </title>

    <style type="text/css">
        * {
            font-family: 'Times New Roman', Times, serif;
        }

        table {
            font-size: small;
        }

        .gray {
            background-color: lightgray
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h3>PT. TRESNAMUDA SEJATI (TMS LINES)</h3>
        <h4 class="h3-text-center">Laporan Prakiraan Cuaca Pelabuhan</h4>
    </div>
    <br />
    <br />
    <br />
    <br />
    <table>
        <tr>
            <td width=17%>Dibuat Tanggal</td>
            <td width=3%>:</td>
            <td><?= date('d F Y H:i:s') ?></td>
        </tr>
        <tr>
            <td>Dibuat Oleh</td>
            <td>:</td>
            <td><?= userLogin()->fullname ?></td>
        </tr>
    </table>
    <br />
    <br />

    <table width="100%">
        <tr>
            <td><strong>Pelabuhan : </strong><?= $cuaca->name; ?></td>
            <td align="right"><strong>Waktu Prakiraan Cuaca : </strong>
                <?php $validFrom = $cuaca->valid_from;
                echo date("d M Y H:i", strtotime($validFrom)); ?> -
                <?php $validTo = $cuaca->valid_to;
                echo date("d M Y H:i", strtotime($validTo)); ?>
            </td>
        </tr>
    </table>
    <br />
    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Kondisi Cuaca</th>
                <th>Suhu &deg;C</th>
                <th>Kelembapan %</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center" width=30%><?= $cuaca->weather; ?></td>
                <td align="center"><?= $cuaca->temp_min; ?> - <?= $cuaca->temp_max; ?></td>
                <td align="center"><?= $cuaca->rh_min; ?> - <?= $cuaca->rh_max; ?></td>
            </tr>
        </tbody>
    </table>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 100%;">
                    <span>&copy; <?= date('Y') ?> - Sumber Cuaca : https://www.bmkg.go.id/</span>
                </td>
                <td align="right" style="width: 100%;">
                    <span>dan https://peta-maritim.bmkg.go.id/public_api/pelabuhan</span>
                </td>
            </tr>

        </table>
    </div>
</body>

</html>