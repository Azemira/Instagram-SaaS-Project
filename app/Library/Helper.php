<?php

namespace App\Library;

class Helper
{
    public static function bytes_to_human($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function sec_to_hms($seconds)
    {
        if ($seconds) {
            $hours = floor($seconds / 3600);
            $mins  = floor($seconds / 60 % 60);
            $secs  = floor($seconds % 60);

            return sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        }
        return '00:00:00';
    }

    public static function calc_bar($completed, $max)
    {
        $max       = ($max <= 0 ? 1 : $max);
        $completed = ($completed > $max ? $max : $completed);

        return round($completed * 100 / $max);
    }

    public static function setEnv($name, $value)
    {
        $path = base_path('.env');

        file_put_contents($path, str_replace(
            $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
        ));

    }

}
