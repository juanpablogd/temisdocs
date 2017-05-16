<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tercero".
 *
 * @property string $idtercero
 * @property string $nombre
 * @property string $apellido
 * @property string $telefono
 * @property string $direccion
 * @property string $idciudad
 *
 * @property Documento[] $documentos
 * @property Ciudad $idciudad0
 */
class Tercero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tercero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'idciudad'], 'required'],
            [['nombre', 'apellido'], 'string', 'max' => 50],
            [['telefono'], 'string', 'max' => 60],
            [['direccion'], 'string', 'max' => 100],
            [['idciudad'], 'string', 'max' => 5],
            [['idciudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::className(), 'targetAttribute' => ['idciudad' => 'idciudad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtercero' => 'Idtercero',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'idciudad' => 'Ciudad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['tercero_idtercero' => 'idtercero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdciudad0()
    {
        return $this->hasOne(Ciudad::className(), ['idciudad' => 'idciudad']);
    }
}
