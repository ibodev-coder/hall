<?php
if (!function_exists('convert')) {
    function convert($nilai)
    {
        //    nilai constan gram
        // kg to gram x 1000
        //box,liter,pcs tidak di convert
        return $nilai * 1000;
    }
}
