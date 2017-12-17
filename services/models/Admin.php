<?php

namespace services\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $update_at
 * @property integer $last_login_time
 * @property string $last_login_ip
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $code;
    public $password;
    public $role=[];
    const SCENARIO_ADD="add";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tel','username'],'required','message'=>'{attribute}不能为空'],
            [['username','email'],'unique','message'=>'该{attribute}已存在'],
            [['tel'], 'number', 'numberPattern' =>'/^1[3578]\d{9}$/','message'=>'手机号码格式不正确'],
            ['password','string'],
            ['email','email'],
            ['role','safe'],
            ['password','required','on'=>self::SCENARIO_ADD],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'tel' => '联系方式',
            'role'=>'所属角色',
            'code'=>'验证'
        ];
    }
    //save之前要执行的操作  必须返回true，否则save（）方法不会执行
//    public function beforeSave($insert)
//    {
//        if($insert){
//            $this->status = 10;
//            $this->created_at = time();
//            $this->auth_key = \Yii::$app->security->generateRandomString();
//        }else{
//            $this->update_at = time();
//        }
//        if($this->password){
//            $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
//        }
//
//        return parent::beforeSave($insert);
//    }
    public function beforeSave($insert){
        if($insert){
            $this->status=1;
            $this->created_at=time();
            $this->auth_key=Yii::$app->security->generateRandomString();
        }else{
            $this->update_at=time();
        }
        if($this->password){
            $this->password_hash=Yii::$app->security->generatePasswordHash($this->password);
        }
        return parent::beforeSave($insert);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id'=>$id]);
        // TODO: Implement findIdentity() method.
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
        // TODO: Implement getId() method.
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
        // TODO: Implement validateAuthKey() method.
    }
}
