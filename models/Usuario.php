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
 *
 * @property Documento[] $documentos
 */
class Usuario extends \yii\db\ActiveRecord
{
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
            [['nombre', 'usuario', 'contrasena', 'estado', 'perfil'], 'required'],
            [['estado', 'perfil'], 'string'],
            [['nombre'], 'string', 'max' => 100],
            [['usuario', 'contrasena'], 'string', 'max' => 45],
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
            'estado' => 'Estado',
            'perfil' => 'Perfil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['usuario_idusuario' => 'idusuario']);
    }
}
