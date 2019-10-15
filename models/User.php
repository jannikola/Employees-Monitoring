<?php

namespace app\models;

use app\components\orm\ActiveRecord;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $is_deleted
 */

class User extends ActiveRecord implements IdentityInterface
{

    public $auth_key;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public static function findByUsernameOrEmail($name)
    {
        return self::find()->where(['email' => $name])->orWhere(['username' => $name])->one();
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
}
