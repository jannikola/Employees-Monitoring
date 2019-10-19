<?php


namespace app\helpers;

use DateTime;

class TimeHelper
{
    const DATE_FORMAT = 'd/m/Y';
    const SQL_DATE_FORMAT = 'Y-m-d';

    public static function formatSqlDateToLocalDate($date)
    {
        return TimeHelper::changeDateTimeFormat($date, TimeHelper::SQL_DATE_FORMAT, TimeHelper::DATE_FORMAT);
    }

    public static function changeDateTimeFormat($inputDate, $inputFormat, $outputFormat)
    {
        $dateTime = DateTime::createFromFormat($inputFormat, $inputDate);

        if ($dateTime) {
            return $dateTime->format($outputFormat);
        }

        return $inputDate;
    }
}
