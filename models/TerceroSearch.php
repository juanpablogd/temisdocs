<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tercero;

/**
 * TerceroSearch represents the model behind the search form about `app\models\Tercero`.
 */
class TerceroSearch extends Tercero
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtercero', 'nombres', 'apellido', 'telefono', 'direccion', 'idciudad'], 'safe'],
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
        $query = Tercero::find();

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

        $query->joinWith('idciudad0');

        // grid filtering conditions
        $query->andFilterWhere(['like', 'idtercero', $this->idtercero])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'ciudad.nombre', $this->idciudad]);

        return $dataProvider;
    }
}
