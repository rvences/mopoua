<?php

namespace backend\modules\nomina\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\nomina\models\Colaboradores;

/**
 * ColaboradoresSearch represents the model behind the search form about `backend\modules\nomina\models\Colaboradores`.
 */
class ColaboradoresSearch extends Colaboradores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'puesto', 'tabulador'], 'integer'],
            [['clave', 'nombre', 'apaterno', 'amaterno', 'rfc', 'curp', 'nss', 'tipo', 'fingreso', 'fbaja'], 'safe'],
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
        $query = Colaboradores::find();

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
            'puesto' => $this->puesto,
            'tabulador' => $this->tabulador,
            'fingreso' => $this->fingreso,
            'fbaja' => $this->fbaja,
        ]);

        $query->andFilterWhere(['like', 'clave', $this->clave])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apaterno', $this->apaterno])
            ->andFilterWhere(['like', 'amaterno', $this->amaterno])
            ->andFilterWhere(['like', 'rfc', $this->rfc])
            ->andFilterWhere(['like', 'curp', $this->curp])
            ->andFilterWhere(['like', 'nss', $this->nss])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
