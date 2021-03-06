<?php

namespace backend\modules\nomina\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\nomina\models\FechasPago;

/**
 * FechasPagoSearch represents the model behind the search form about `backend\modules\nomina\models\FechasPago`.
 */
class FechasPagoSearch extends FechasPago
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_dias', 'created_at', 'updated_at', 'created_by', 'updated_by', 'temporalidad_pago_id'], 'integer'],
            [['de', 'hasta', 'fecha_pago'], 'safe'],
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
        $query = FechasPago::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'de' => $this->de,
            'hasta' => $this->hasta,
            'total_dias' => $this->total_dias,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'fecha_pago' => $this->fecha_pago,
            'temporalidad_pago_id' => $this->temporalidad_pago_id,
        ]);

        return $dataProvider;
    }
}
