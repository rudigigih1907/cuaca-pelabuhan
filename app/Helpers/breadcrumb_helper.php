<?php

if (!function_exists('render_breadcrumb')) {
    /**
     * Render Bootstrap 5 Breadcrumb
     *
     * @param array $breadcrumbs Array asosiatif ['Label' => 'url', 'Label Aktif' => '']
     * @return string HTML Breadcrumb
     */
    function render_breadcrumb(array $breadcrumbs = []): string
    {
        if (empty($breadcrumbs)) {
            return '';
        }

        $html = '<nav aria-label="breadcrumb">';
        $html .= '<ol class="breadcrumb mb-3">';

        $total = count($breadcrumbs);
        $i = 1;

        foreach ($breadcrumbs as $label => $url) {
            $isLast = ($i === $total) || empty($url);

            if ($isLast) {
                // Item aktif (halaman saat ini), tidak ada tag <a>
                $html .= '<li class="breadcrumb-item active" aria-current="page">' . esc($label) . '</li>';
            } else {
                // Link sebelumnya
                $html .= '<li class="breadcrumb-item"><a href="' . esc($url) . '" class="text-decoration-none">' . esc($label) . '</a></li>';
            }

            $i++;
        }

        $html .= '</ol>';
        $html .= '</nav>';

        return $html;
    }
}
