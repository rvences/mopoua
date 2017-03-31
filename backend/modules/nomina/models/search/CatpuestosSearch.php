<?php

namespace backend\modules\nomina\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\nomina\models\Catpuestos;

/**
 * CatpuestosSearch represents the model behind the search form about `backend\modules\nomina\models\Catpuestos`.
 */
class CatpuestosSearch extends Catpuestos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['puesto', 'requisitos', 'funciones', 'habilidades', 'conocimientos'], 'safe'],
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
        $query = Catpuestos::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'puesto', $this->puesto])
            ->andFilterWhere(['like', 'requisitos', $this->requisitos])
            ->andFilterWhere(['like', 'funciones', $this->funciones])
            ->andFilterWhere(['like', 'habilidades', $this->habilidades])
            ->andFilterWhere(['like', 'conocimientos', $this->conocimientos]);

        return $dataProvider;
    }
}
