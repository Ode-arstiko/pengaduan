<?php

if (!function_exists('getInitials')) {
    function getInitials($name)
    {
        $parts = explode(' ', trim($name));
        $initials = '';
        foreach ($parts as $i => $part) {
            if ($i >= 2) break; // cuma ambil 2 kata pertama
            $initials .= substr($part, 0, 1);
        }
        return strtoupper($initials);
    }
}
