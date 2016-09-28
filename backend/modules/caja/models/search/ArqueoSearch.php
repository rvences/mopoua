<?php

namespace backend\modules\caja\models\search;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\caja\models\Arqueo;

/**
 * ArqueoSearch represents the model behind the search form about `backend\modules\caja\models\Arqueo`.
 */
class ArqueoSearch extends Arqueo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'farqueo', 'comentario'], 'safe'],
            [['efectivoapertura', 'efectivocierre', 'efectivosistema', 'dineroelectronico', 'efectivoadeudoanterior', 'depositoempresa', 'retiroempresa', 'egresocompras', 'egresocomprasservicio', 'efectivofisico', 'adeudoanterior', 'adeudoactual', 'ventaturno', 'egresoturno'], 'number'],
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
        $query = Arqueo::find();

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
            'farqueo' => $this->farqueo,
            'efectivoapertura' => $this->efectivoapertura,
            'efectivocierre' => $this->efectivocierre,
            'efectivosistema' => $this->efectivosistema,
            'dineroelectronico' => $this->dineroelectronico,
            'efectivoadeudoanterior' => $this->efectivoadeudoanterior,
            'depositoempresa' => $this->depositoempresa,
            'retiroempresa' => $this->retiroempresa,
            'egresocompras' => $this->egresocompras,
            'egresocomprasservicio' => $this->egresocomprasservicio,
            'efectivofisico' => $this->efectivofisico,
            'adeudoanterior' => $this->adeudoanterior,
            'adeudoactual' => $this->adeudoactual,
            'ventaturno' => $this->ventaturno,
            'egresoturno' => $this->egresoturno,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}