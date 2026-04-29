<?php

class UploadQualityHelper {
    public static function validateDocument(string $tmpName, string $mime): array {
        $mime = strtolower($mime);
        if ($mime === 'application/pdf') {
            return ['ok' => true];
        }

        if (!in_array($mime, ['image/jpeg', 'image/png'], true)) {
            return ['ok' => true];
        }

        if (!function_exists('getimagesize')) {
            return ['ok' => true];
        }

        $size = @getimagesize($tmpName);
        if (!$size) {
            return ['ok' => false, 'error' => 'We could not read the uploaded image. Please upload a clear image.'];
        }

        $width = (int) ($size[0] ?? 0);
        $height = (int) ($size[1] ?? 0);
        if ($width < 500 || $height < 500) {
            return ['ok' => false, 'error' => 'Image quality appears too low (minimum 500x500).'];
        }

        if (function_exists('imagecreatefromjpeg') && function_exists('imagecreatefrompng')) {
            $blurScore = self::estimateBlur($tmpName, $mime);
            if ($blurScore !== null && $blurScore < 8.0) {
                return ['ok' => false, 'error' => 'Image looks blurry. Please upload a sharper document photo or scan.'];
            }
        }

        return ['ok' => true];
    }

    private static function estimateBlur(string $tmpName, string $mime): ?float {
        $img = null;
        if ($mime === 'image/jpeg' && function_exists('imagecreatefromjpeg')) {
            $img = @imagecreatefromjpeg($tmpName);
        } elseif ($mime === 'image/png' && function_exists('imagecreatefrompng')) {
            $img = @imagecreatefrompng($tmpName);
        }

        if (!$img) {
            return null;
        }

        $w = imagesx($img);
        $h = imagesy($img);
        if ($w <= 0 || $h <= 0) {
            imagedestroy($img);
            return null;
        }

        $sampleW = min(240, $w);
        $sampleH = min(240, $h);
        $sample = imagecreatetruecolor($sampleW, $sampleH);
        imagecopyresampled($sample, $img, 0, 0, 0, 0, $sampleW, $sampleH, $w, $h);
        imagefilter($sample, IMG_FILTER_GRAYSCALE);

        $sum = 0.0;
        $sumSq = 0.0;
        $n = 0;

        for ($y = 1; $y < $sampleH - 1; $y++) {
            for ($x = 1; $x < $sampleW - 1; $x++) {
                $center = imagecolorat($sample, $x, $y) & 0xFF;
                $left = imagecolorat($sample, $x - 1, $y) & 0xFF;
                $right = imagecolorat($sample, $x + 1, $y) & 0xFF;
                $up = imagecolorat($sample, $x, $y - 1) & 0xFF;
                $down = imagecolorat($sample, $x, $y + 1) & 0xFF;
                $lap = abs((4 * $center) - $left - $right - $up - $down);
                $sum += $lap;
                $sumSq += $lap * $lap;
                $n++;
            }
        }

        imagedestroy($sample);
        imagedestroy($img);

        if ($n === 0) {
            return null;
        }

        $mean = $sum / $n;
        $variance = max(0.0, ($sumSq / $n) - ($mean * $mean));
        return sqrt($variance);
    }
}
