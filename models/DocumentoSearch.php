<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Documento;

/**
 * DocumentoSearch represents the model behind the search form about `app\models\Documento`.
 */
class DocumentoSearch extends Documento
{
    /**
     * @inheritdoc  http://www.yiiframework.com/wiki/851/yii2-gridview-sorting-and-searching-with-a-junction-table-column-many-to-many-relationship/
     */
    public $nombres;
    public $apellido;

    public function rules()
    {
        return [
            [['iddocumento', 'usuario_idusuario'], 'integer'],
            [['ruta', 'fechasis', 'tipodoc_idtipodoc', 'tercero_idtercero','nombres','apellido'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {   //print_r($params);
        $query = Documento::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['ruta', 'fechasis', 'tercero_idtercero', 'nombres', 'apellido', 'tipodoc_idtipodoc']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('tipodocIdtipodoc');
        $query->joinWith('terceroIdtercero');
        //$query->joinWith('usuarioIdusuario');

        // grid filtering conditions
        $query->andFilterWhere(['like', 'ruta', $this->ruta])
            ->andFilterWhere(['like', 'fechasis', $this->fechasis])
            ->andFilterWhere(['like', 'tercero_idtercero', $this->tercero_idtercero])
            ->andFilterWhere(['like', 'tercero.nombres', $this->nombres])
            ->andFilterWhere(['like', 'tercero.apellido', $this->apellido])
            ->andFilterWhere(['like', 'tipodoc.nombre', $this->tipodoc_idtipodoc]);

        return $dataProvider;
    }
}
