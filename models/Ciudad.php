<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property string $idciudad
 * @property string $nombre
 * @property string $departamento
 *
 * @property Tercero[] $terceros
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idciudad', 'nombre', 'departamento'], 'required'],
            [['idciudad'], 'string', 'max' => 5],
            [['nombre'], 'string', 'max' => 50],
            [['departamento'], 'string', 'max' => 30],
            [['idciudad'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idciudad' => 'Cod Dane',
            'nombre' => 'Nombre',
            'departamento' => 'Departamento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerceros()
    {
        return $this->hasMany(Tercero::className(), ['idciudad' => 'idciudad']);
    }
    
    public function getNomdane()
    {
        return $this->nombre.' '.$this->departamento;
    }

}
