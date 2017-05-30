<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "usuario".
 *
 * @property integer $idusuario
 * @property string $nombre
 * @property string $usuario
 * @property string $contrasena
 * @property string $estado
 * @property string $perfil
 * @property string $authKey
 *
 * @property Documento[] $documentos
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $password_repeat;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'usuario', 'contrasena','password_repeat', 'estado', 'perfil'], 'required'],
            [['estado', 'perfil'], 'string'],
            [['nombre'], 'string', 'max' => 100],
            [['usuario', 'contrasena'], 'string', 'max' => 45],
            [['authKey'], 'string', 'max' => 50],
            ['password_repeat', 'compare', 'compareAttribute'=>'contrasena', 'message'=>"Contraseña diferente" ]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusuario' => 'Idusuario',
            'nombre' => 'Nombre',
            'usuario' => 'Usuario',
            'contrasena' => 'Contrasena',
            'password_repeat' => 'Repetir Contrasena',
            'estado' => 'Estado',
            'perfil' => 'Perfil',
            'authKey' => 'authKey',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['usuario_idusuario' => 'idusuario']);
    }

    /**
     * ******************AUTENTICACIÓN*************************
     */
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //echo '<script type="text/javascript">alert("Data has been submitted to ' . $id . '");</script>';
        return self::findOne(['idusuario'=>$id]);
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
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['Usuario'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->idusuario;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
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
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->contrasena === $password;
    }
    /**
     * @inheritdoc
     */
    public static function findPerfil($id)
    {
        //echo '<script type="text/javascript">alert("Data has been submitted to ' . $id . '");</script>';
        return self::findOne(['idusuario'=>$id])->select('perfil');;
    }
}
