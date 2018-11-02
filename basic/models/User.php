<?php

namespace app\models;

use yii\base\Exception;

class User extends Registers implements \yii\web\IdentityInterface
{

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByUsername($email)
    {
        return self::find()->where(['email'=>$email])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->r_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if(!is_null($this->password) && strlen($this->password) > 0){
            return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
        }
        return false;
    }

    public function getUserdata()
    {
        return $this;
    }
}
