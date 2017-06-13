<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property integer $iddocumento
 * @property string $ruta
 * @property string $fechasis
 * @property string $tercero_idtercero
 * @property integer $tipodoc_idtipodoc
 * @property integer $usuario_idusuario
 *
 * @property Tercero $terceroIdtercero
 * @property Tipodoc $tipodocIdtipodoc
 * @property Usuario $usuarioIdusuario
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $file;

    public static function tableName()
    {
        return 'documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruta', 'fechasis', 'tercero_idtercero', 'tipodoc_idtipodoc', 'usuario_idusuario', 'file'], 'required'],
            [['tipodoc_idtipodoc', 'usuario_idusuario'], 'integer'],
            [['ruta'], 'string', 'max' => 255],
            [['fechasis'], 'string', 'max' => 45],
            [['referencia'], 'string', 'max' => 50],
            [['tercero_idtercero'], 'string', 'max' => 12],
            [['file'], 'file'],
            [['tercero_idtercero'], 'exist', 'skipOnError' => true, 'targetClass' => Tercero::className(), 'targetAttribute' => ['tercero_idtercero' => 'idtercero']],
            [['tipodoc_idtipodoc'], 'exist', 'skipOnError' => true, 'targetClass' => Tipodoc::className(), 'targetAttribute' => ['tipodoc_idtipodoc' => 'idtipodoc']],
            [['usuario_idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_idusuario' => 'idusuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddocumento' => 'Iddocumento',
            'ruta' => 'Archivo',
            'fechasis' => 'Fecha',
            'tercero_idtercero' => 'Tercero - CC / NIT / TI',
            'tipodoc_idtipodoc' => 'Tipo',
            'referencia' => 'Referencia',
            'usuario_idusuario' => 'Usuario',
            'file' => 'Archivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerceroIdtercero()
    {
        return $this->hasOne(Tercero::className(), ['idtercero' => 'tercero_idtercero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipodocIdtipodoc()
    {
        return $this->hasOne(Tipodoc::className(), ['idtipodoc' => 'tipodoc_idtipodoc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'usuario_idusuario']);
    }
}
