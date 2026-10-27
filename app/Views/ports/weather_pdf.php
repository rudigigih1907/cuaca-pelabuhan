<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0 0 5px 0;
            text-transform: uppercase;
            color: #0d6efd;
            font-size: 16pt;
        }

        .header p {
            margin: 0;
            font-size: 9pt;
            color: #666;
        }

        .table-weather {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-weather th,
        .table-weather td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            font-size: 8.5pt;
        }

        .table-weather th {
            background-color: #0d6efd;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }

        .table-weather tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            font-size: 8pt;
            text-align: right;
            color: #888;
        }
    </style>
</head>

<body>

    <?php
    $province = $port['province'] ?? null;
    $tzInfo   = get_province_timezone($province);
    ?>

    <div class="header">
        <h2>Laporan Prakiraan Cuaca Pelabuhan</h2>
        <p>
            <strong>Nama Pelabuhan:</strong> <?= esc($port['name'] ?? $port['code']) ?> (Kode: <?= esc($port['code']) ?>)
            <?php if (!empty($province)): ?>
                | <strong>Wilayah:</strong> <?= esc($province) ?> (<?= esc($tzInfo['label']) ?> / <?= esc($tzInfo['utc']) ?>)
            <?php endif; ?>
        </p>
        <p><strong>Periode:</strong> <?= !empty($startDate) ? $startDate : 'Awal' ?> s/d <?= !empty($endDate) ? $endDate : 'Akhir' ?></p>
    </div>

    <table class="table-weather">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="14%">Waktu (<?= esc($tzInfo['label']) ?>)</th>
                <th width="10%">Cuaca</th>
                <th width="7%">Suhu (°C)</th>
                <th width="7%">RH (%)</th>
                <th width="8%">Vis. (NM)</th>
                <th width="9%">Arah Angin</th>
                <th width="9%">Kept. Angin</th>
                <th width="9%">Gelombang</th>
                <th width="11%">Kat. Gelombang</th>
                <th width="12%">Arus</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($weathers as $w) : ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center">
                        <?= date('d M Y - H:i', strtotime($w['forecast_time'])) ?>
                    </td>
                    <td><?= ucfirst(esc($w['weather'] ?? '-')) ?></td>
                    <td class="text-center"><?= esc($w['temp_avg'] ?? '-') ?></td>
                    <td class="text-center"><?= esc($w['rh_avg'] ?? '-') ?></td>
                    <td class="text-center"><?= esc($w['visibility'] ?? '-') ?></td>
                    <td class="text-center"><?= esc($w['wind_from'] ?? '-') ?></td>
                    <td class="text-center"><?= esc($w['wind_speed'] ?? 0) ?> Kt</td>
                    <td class="text-center"><?= esc($w['wave_height'] ?? 0) ?> m</td>
                    <td class="text-center"><?= esc($w['wave_cat'] ?? '-') ?></td>
                    <td class="text-center">
                        <?= esc($w['current_to'] ?? '-') ?> / <?= esc($w['current_speed'] ?? 0) ?> Kt
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <?php
        $now = new \DateTime('now', new \DateTimeZone($tzInfo['timezone']));
        ?>
        Dicetak pada: <?= $now->format('d-m-Y H:i:s') ?> <?= esc($tzInfo['label']) ?> | Sumber Data:<a href="https://maritim.bmkg.go.id/apidoc"> BMKG</a>
    </div>

</body>

</html>