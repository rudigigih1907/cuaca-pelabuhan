<?php

use CodeIgniter\I18n\Time;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Cuaca <?= $cuaca->name ?>/<?= $cuaca->valid_from ?>-<?= $cuaca->valid_to ?> </title>

    <style>
        table {
            font-family: arial, 'Times New Roman', Times, serif;
            border-collapse: collapse;
            width: 100%;
        }
        td,
        th {
            border: 0px solid #000000;
            text-align: left;
            height: 20px;
            margin: 8px;
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
    <table>
        <tr>
        </tr>
    </table>
    <br />
    <br />
    <br />

</body>

</html>