<?php

namespace backend\modules\nomina\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\nomina\models\Nomina;

/**
 * NominaSearch represents the model behind the search form of `backend\modules\nomina\models\Nomina`.
 */
class NominaSearch extends Nomina
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fecha_pago_id', 'puesto_id', 'created_by', 'created_at'], 'integer'],
            [['salario_neto', 'colaborador_id'], 'number'],
            [['colaborador', 'puesto', 'forma_pago', 'numero_cuenta'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Nomina::find();

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
            'fecha_pago_id' => $this->fecha_pago_id,
            'salario_neto' => $this->salario_neto,
            'colaborador_id' => $this->colaborador_id,
            'puesto_id' => $this->puesto_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'colaborador', $this->colaborador])
            ->andFilterWhere(['like', 'puesto', $this->puesto])
            ->andFilterWhere(['like', 'forma_pago', $this->forma_pago])
            ->andFilterWhere(['like', 'numero_cuenta', $this->numero_cuenta]);

        return $dataProvider;
    }
}
