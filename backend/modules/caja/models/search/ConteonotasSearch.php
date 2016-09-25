<?php

namespace backend\modules\caja\models\search;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\caja\models\Conteonotas;

/**
 * ConteonotasSearch represents the model behind the search form about `backend\modules\caja\models\Conteonotas`.
 */
class ConteonotasSearch extends Conteonotas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'arqueo_id'], 'integer'],
            [['username', 'fconteo', 'tipo', 'descripcion', 'formapago'], 'safe'],
            [['cantidad'], 'number'],
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
        $query = Conteonotas::find();

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
            'fconteo' => $this->fconteo,
            'cantidad' => $this->cantidad,
            'arqueo_id' => $this->arqueo_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'formapago', $this->formapago]);

        return $dataProvider;
    }
}
