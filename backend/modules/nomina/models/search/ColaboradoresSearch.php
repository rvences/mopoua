<?php

namespace backend\modules\nomina\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\nomina\models\Colaboradores;
use yii\db\Expression;

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
            [['id', 'puesto_id', 'temporalidad_pago_id'], 'integer'],
            [['bcolaborador_nombre', 'clave', 'nombre', 'apaterno', 'amaterno', 'rfc', 'curp', 'nss', 'fingreso', 'fbaja', 'activo'], 'safe'],
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
        $colaboradorNombre = new Expression('CONCAT_WS(" ", nombre, apaterno, amaterno)');
        $query = Colaboradores::find();

        $query->select([
            'colaboradores.*',
            'bcolaborador_nombre' => $colaboradorNombre,
        ]);

        $query->orderBy('bcolaborador_nombre ASC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'bcolaborador_nombre' => [
                      'asc' => [(string)$colaboradorNombre => SORT_ASC],
                      'desc' => [(string)$colaboradorNombre => SORT_DESC],
                    ]
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'puesto_id' => $this->puesto_id,
            'fingreso' => $this->fingreso,
            'fbaja' => $this->fbaja,
            'temporalidad_pago_id' => $this->temporalidad_pago_id,
        ]);

        $query->andFilterWhere(['like', 'clave', $this->clave])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apaterno', $this->apaterno])
            ->andFilterWhere(['like', 'amaterno', $this->amaterno])
            ->andFilterWhere(['like', 'rfc', $this->rfc])
            ->andFilterWhere(['like', 'curp', $this->curp])
            ->andFilterWhere(['like', 'nss', $this->nss])
            ->andFilterWhere(['like', 'activo', $this->activo])
            ->andFilterWhere(['like', $colaboradorNombre, $this->bcolaborador_nombre])
         ;

        return $dataProvider;
    }
}
