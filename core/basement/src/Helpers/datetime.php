<?php
    use Carbon\Carbon;
        if (!function_exists('format_time')) {
        /**
         * @param Carbon $timestamp
         * @param $format
         * @return mixed
         */
            function format_time(Carbon $timestamp, $format = 'j M Y H:i')
            {
                $first = Carbon::create(0000, 0, 0, 00, 00, 00);
                if ($timestamp->lte($first)) {
                    return '';
                }

                return $timestamp->format($format);
            }
        }

        if (!function_exists('date_from_database')) {
        /**
         * @param $time
         * @param string $format
         * @return mixed
         */
        
        function date_from_database($time, $format = 'Y-m-d')
            {
                if (empty($time)) {
                    return $time;
                }
                return format_time(Carbon::parse($time), $format);
            }
        }
