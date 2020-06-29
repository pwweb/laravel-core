<?php

if (false === function_exists('hexToRgb')) {
    function hexToRgb($hex)
    {
        if ('#' === $hex[0]) {
            $hex = substr($hex, 1);
        }

        if (3 === strlen($hex)) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }

        $r = hexdec($hex[0].$hex[1]);
        $g = hexdec($hex[2].$hex[3]);
        $b = hexdec($hex[4].$hex[5]);

        return $b + ($g << 0x8) + ($r << 0x10);
    }
}

if (false === function_exists('rgbToHsl')) {
    function rgbToHsl($rgb)
    {
        $r = 0xFF & ($rgb >> 0x10);
        $g = 0xFF & ($rgb >> 0x8);
        $b = 0xFF & $rgb;

        $r = ((float) $r) / 255.0;
        $g = ((float) $g) / 255.0;
        $b = ((float) $b) / 255.0;

        $maxC = max($r, $g, $b);
        $minC = min($r, $g, $b);

        $l = ($maxC + $minC) / 2.0;

        if ($maxC === $minC) {
            $h = 0;
            $s = 0;
        } else {
            if ($l < 0.5) {
                $s = ($maxC - $minC) / ($maxC + $minC);
            } else {
                $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
            }

            if ($r === $maxC) {
                $h = ($g - $b) / ($maxC - $minC);
            }
            if ($g === $maxC) {
                $h = 2.0 + ($b - $r) / ($maxC - $minC);
            }
            if ($b === $maxC) {
                $h = 4.0 + ($r - $g) / ($maxC - $minC);
            }

            $h = $h / 6.0;
        }

        $h = (int) round(255.0 * $h);
        $s = (int) round(255.0 * $s);
        $l = (int) round(255.0 * $l);

        return (object) ['hue' => $h, 'saturation' => $s, 'luminance' => $l];
    }
}
