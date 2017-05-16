<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tipodoc;

/**
 * TipodocSearch represents the model behind the search form about `app\models\Tipodoc`.
 */
class TipodocSearch extends Tipodoc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtipodoc'], 'integer'],
            [['nombre', 'decripcion', 'estado'], 'safe'],
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
    {
        $query = Tipodoc::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idtipodoc' => $this->idtipodoc,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'decripcion', $this->decripcion])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
