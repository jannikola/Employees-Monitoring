<?php

namespace app\helpers;

class FlashHelper
{
    public static function setSuccess($message)
    {
        self::setFlashMessage('success', $message);
    }

    public static function setError($message)
    {
        self::setFlashMessage('error', $message);
    }

    protected static function setFlashMessage($type, $message)
    {
        \Yii::$app->getSession()->addFlash($type, $message);
    }
}