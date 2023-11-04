<?php

if (!function_exists('_getLevel')) {
    function _getLevel(int $var): string
    {
        switch ($var) {
            case 1:
                return "Developer";
                break;
            case 2:
                return "Administrator";
                break;
            default:
                return "Operator";
                break;
        }
    }
}
