<?php

namespace backend\modules\nomina\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\nomina\models\MovimientoDiario;

/**
 * MovimientoDiarioSearch represents the model behind the search form about `backend\modules\nomina\models\MovimientoDiario`.
 */
class MovimientoDiarioSearch extends MovimientoDiario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'colaborador_id', 'movimiento_nomina_id', 'nomina_glosa_id', 'created_at', 'created_by'], 'integer'],
            [['movimiento_fecha', 'movimiento_nomina_info', 'aplicado_en_nomina'], 'safe'],
            [['monto'], 'number'],
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
        $query = MovimientoDiario::find();

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
            'colaborador_id' => $this->colaborador_id,
            'movimiento_fecha' => $this->movimiento_fecha,
            'movimiento_nomina_id' => $this->movimiento_nomina_id,
            'monto' => $this->monto,
            'nomina_glosa_id' => $this->nomina_glosa_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'movimiento_nomina_info', $this->movimiento_nomina_info])
            ->andFilterWhere(['like', 'aplicado_en_nomina', $this->aplicado_en_nomina]);

        return $dataProvider;
    }
}
