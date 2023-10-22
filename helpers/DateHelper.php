<?php

namespace app\helpers;

use DateTime;

class DateHelper
{
    public static function getCurrentStringDate(): string
    {
        return (new DateTime())->format('Y-m-d H:i:s');
    }
}