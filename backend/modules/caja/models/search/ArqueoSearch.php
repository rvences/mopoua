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
            [['id', 'liquidoadeudo'], 'integer'],
            [['username', 'farqueo', 'comentario'], 'safe'],
            [['montoadeudo', 'montoapertura', 'montocierre', 'montoingreso', 'montoegreso', 'montoretiro'], 'number'],
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
            'montoadeudo' => $this->montoadeudo,
            'montoapertura' => $this->montoapertura,
            'montocierre' => $this->montocierre,
            'montoingreso' => $this->montoingreso,
            'montoegreso' => $this->montoegreso,
            'montoretiro' => $this->montoretiro,
            'liquidoadeudo' => $this->liquidoadeudo,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
