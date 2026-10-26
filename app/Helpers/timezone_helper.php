<?php

if (!function_exists('get_province_timezone')) {
    /**
     * Mengambil identifier zona waktu PHP, label zona, dan offset berdasarkan nama provinsi
     *
     * @param string|null $province
     * @return array
     */
    function get_province_timezone(?string $province): array
    {
        $prov = strtolower(trim((string) $province));

        // WITA (UTC+8) - Bali, NTB, NTT, Kalimantan (kecuali Kalbar & Kalteng), Sulawesi
        $witaProvinces = [
            'bali',
            'nusa tenggara barat',
            'ntb',
            'nusa tenggara timur',
            'ntt',
            'kalimantan selatan',
            'kalsel',
            'kalimantan timur',
            'kaltim',
            'kalimantan utara',
            'kaltara',
            'sulawesi utara',
            'sulut',
            'sulawesi tengah',
            'sulteng',
            'sulawesi selatan',
            'sulsel',
            'sulawesi tenggara',
            'sultra',
            'gorontalo',
            'sulawesi barat',
            'sulbar'
        ];

        // WIT (UTC+9) - Maluku dan Seluruh Papua
        $witProvinces = [
            'maluku',
            'maluku utara',
            'papua',
            'papua barat',
            'papua barat daya',
            'papua selatan',
            'papua tengah',
            'papua pegunungan'
        ];

        foreach ($witProvinces as $w) {
            if (str_contains($prov, $w)) {
                return [
                    'timezone' => 'Asia/Jayapura',
                    'label'    => 'WIT',
                    'utc'      => 'UTC+9',
                ];
            }
        }

        foreach ($witaProvinces as $w) {
            if (str_contains($prov, $w)) {
                return [
                    'timezone' => 'Asia/Makassar',
                    'label'    => 'WITA',
                    'utc'      => 'UTC+8',
                ];
            }
        }

        // Default WIB (UTC+7) - Seluruh Sumatra, Jawa, Kalbar, Kalteng
        return [
            'timezone' => 'Asia/Jakarta',
            'label'    => 'WIB',
            'utc'      => 'UTC+7',
        ];
    }
}

if (!function_exists('format_local_weather_time')) {
    /**
     * Mengonversi waktu forecast UTC ke waktu lokal provinsi
     *
     * @param string|null $utcTime Format datetime (contoh: 2026-10-26 00:00:00)
     * @param string|null $province
     * @param string $format
     * @return string
     */
    function format_local_weather_time(?string $utcTime, ?string $province, string $format = 'd M Y - H:i'): string
    {
        if (empty($utcTime)) {
            return '-';
        }

        $tzInfo = get_province_timezone($province);

        try {
            $dt = new \DateTime($utcTime, new \DateTimeZone('UTC'));
            $dt->setTimezone(new \DateTimeZone($tzInfo['timezone']));
            return $dt->format($format) . ' ' . $tzInfo['label'];
        } catch (\Throwable $e) {
            return date($format, strtotime($utcTime));
        }
    }
}

if (!function_exists('format_local_hour_only')) {
    /**
     * Mengonversi waktu forecast UTC ke jam lokal saja
     */
    function format_local_hour_only(?string $utcTime, ?string $province): string
    {
        if (empty($utcTime)) {
            return '-';
        }

        $tzInfo = get_province_timezone($province);

        try {
            $dt = new \DateTime($utcTime, new \DateTimeZone('UTC'));
            $dt->setTimezone(new \DateTimeZone($tzInfo['timezone']));
            return $dt->format('H:i') . ' ' . $tzInfo['label'];
        } catch (\Throwable $e) {
            return date('H:i', strtotime($utcTime));
        }
    }
}
