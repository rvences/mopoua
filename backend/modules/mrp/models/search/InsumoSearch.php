<?php

namespace backend\modules\mrp\models\search;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\mrp\models\Insumo;

/**
 * InsumoSearch represents the model behind the search form about `backend\modules\mrp\models\Insumo`.
 */
class InsumoSearch extends Insumo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clavepresupuestal_id', 'unidad_id'], 'integer'],
            [['insumo_generico'], 'safe'],
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
        $query = Insumo::find();


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
            'clavepresupuestal_id' => $this->clavepresupuestal_id,
            'unidad_id' => $this->unidad_id,
        ]);

        $query->andFilterWhere(['like', 'insumo_generico', $this->insumo_generico]);

        return $dataProvider;
    }
}
