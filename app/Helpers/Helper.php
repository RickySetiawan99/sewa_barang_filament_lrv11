<?php

namespace App\Helpers;

class Helper
{
    public static function parsing_alert($message)
    {
        $string = '';
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                $string .= ucfirst($value).'<br>';
            }
        } else {
            $string = ucfirst($message);
        }

        return $string;
    }

    public static function swal()
    {
        if (session('success')) {
            alert()->html('', session('success'), 'success');
        }

        if (session('error')) {
            alert()->html('', session('error'), 'error');
        }

        if (session('warning')) {
            alert()->html('', session('warning'), 'warning');
        }
    }

    public static function formatDate($tanggal, $format = 'd F Y')
    {
        return \Carbon\Carbon::parse($tanggal)->format($format);
    }
}
