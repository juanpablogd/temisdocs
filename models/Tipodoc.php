<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipodoc".
 *
 * @property integer $idtipodoc
 * @property string $nombre
 * @property string $decripcion
 * @property string $estado
 *
 * @property Documento[] $documentos
 */
class Tipodoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipodoc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'estado'], 'required'],
            [['estado'], 'string'],
            [['nombre'], 'string', 'max' => 45],
            [['decripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtipodoc' => 'Codigo',
            'nombre' => 'Nombre',
            'decripcion' => 'Decripcion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['tipodoc_idtipodoc' => 'idtipodoc']);
    }
}
