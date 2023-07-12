<?php

namespace Sxtnmedia\SaloonModelify\Helpers;

class Helper
{
    public static function getCaller()
    {
        return debug_backtrace(!DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS, 3)[2]['function'];
    }
}
