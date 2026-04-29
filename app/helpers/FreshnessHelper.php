<?php

class FreshnessHelper {
    public static function stalePages(int $days = 120): array {
        $base = APP_ROOT . '/app/views/pages';
        if (!is_dir($base)) {
            return [];
        }

        $threshold = time() - ($days * 86400);
        $items = [];
        $files = glob($base . '/*.php');
        if (!is_array($files)) {
            return [];
        }

        foreach ($files as $file) {
            $mtime = @filemtime($file);
            if ($mtime === false || $mtime >= $threshold) {
                continue;
            }
            $name = basename($file, '.php');
            $route = '/' . str_replace('_', '-', $name);
            if ($name === 'home') {
                $route = '/';
            }

            $items[] = [
                'file' => $file,
                'page' => ucwords(str_replace('-', ' ', $name)),
                'route' => $route,
                'last_modified' => date('Y-m-d', $mtime),
                'days_old' => (int) floor((time() - $mtime) / 86400),
            ];
        }

        usort($items, fn($a, $b) => $b['days_old'] <=> $a['days_old']);
        return $items;
    }
}
