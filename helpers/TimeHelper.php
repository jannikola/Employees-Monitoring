<?php


namespace app\helpers;

use DateTime;
use DateTimeZone;

class TimeHelper
{
    const DATE_FORMAT = 'd/m/Y';
    const SQL_DATE_FORMAT = 'Y-m-d';
    const TIME_FORMAT = 'H:i:s';
    const SHORT_TIME_FORMAT = 'H:i';

    const DEFAULT_SERVER_TIMEZONE = 'Europe/Sarajevo';

    public static function formatSqlDateToLocalDate($date)
    {
        return TimeHelper::changeDateTimeFormat($date, TimeHelper::SQL_DATE_FORMAT, TimeHelper::DATE_FORMAT);
    }

    public static function changeDateTimeFormat($inputDate, $inputFormat, $outputFormat)
    {
        $dateTime = DateTime::createFromFormat($inputFormat, $inputDate,new DateTimeZone(static::DEFAULT_SERVER_TIMEZONE));

        if ($dateTime) {
            return $dateTime->format($outputFormat);
        }

        return $inputDate;
    }

    public static function createDateObjectFromString($date = 'now')
    {
        return new DateTime($date, new DateTimeZone(static::DEFAULT_SERVER_TIMEZONE));
    }

    public static function formatTimeToShortTime($time)
    {
        return TimeHelper::changeDateTimeFormat($time, TimeHelper::TIME_FORMAT, TimeHelper::SHORT_TIME_FORMAT);
    }
}
