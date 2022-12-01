<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Prakiraan Cuaca Pelabuhan Bulan <?php $data = $reports[0]->issued;
    echo date('F Y', strtotime($data)) ?></title>

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
            <td><?= date('d F Y H:i') ?></td>
        </tr>
        <tr>
            <td>Dibuat Oleh</td>
            <td>:</td>
            <td><?= userLogin()->fullname ?></td>
        </tr>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td><?php $data = $reports[0]->issued;echo date('F Y', strtotime($data)) ?></td>
        </tr>
    </table>
    <br />
    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Pelabuhan</th>
                <th>Tanggal Rilis</th>
                <th>Berlaku</th>
                <th>Cuaca</th>
                <th>Temp &deg;C</th>
                <th>Lembab %</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($reports as $report) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td align="center"><?= $report->name; ?></td>
                    <td align="center"><?php $r_issued = $report->issued;
                    echo date('d H:i', strtotime($r_issued)) ?></td>
                    <td align="center"><?php $r_validf = $report->valid_from;
                    echo date('d H:i', strtotime($r_validf)) ?> - <?php $r_validt = $report->valid_to;
                    echo date('d H:i', strtotime($r_validt)) ?></td>
                    <td align="center"><?= $report->weather; ?></td>
                    <td align="center"><?= $report->temp_min; ?> - <?= $report->temp_max; ?></td>
                    <td align="center"><?= $report->rh_min; ?> - <?= $report->rh_max; ?></td>
                </tr>
            <?php endforeach ?>
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