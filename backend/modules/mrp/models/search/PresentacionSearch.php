<?php

namespace backend\modules\mrp\models\search;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\mrp\models\Presentacion;

/**
 * PresentacionSearch represents the model behind the search form about `backend\modules\mrp\models\Presentacion`.
 */
class PresentacionSearch extends Presentacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'insumo_id', 'presentacion', 'presentacionunidad_id', 'equivalencia', 'equivalenciasunidad_id'], 'integer'],
            [['insumo', 'marca'], 'safe'],
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
        $query = Presentacion::find();

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
            'insumo_id' => $this->insumo_id,
            'presentacion' => $this->presentacion,
            'presentacionunidad_id' => $this->presentacionunidad_id,
            'equivalencia' => $this->equivalencia,
            'equivalenciasunidad_id' => $this->equivalenciasunidad_id,
        ]);

        $query->andFilterWhere(['like', 'insumo', $this->insumo])
            ->andFilterWhere(['like', 'marca', $this->marca]);

        return $dataProvider;
    }
}
