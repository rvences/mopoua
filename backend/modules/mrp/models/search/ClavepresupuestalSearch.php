<?php

namespace backend\modules\mrp\models\search;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\mrp\models\Clavepresupuestal;

/**
 * ClavepresupuestalSearch represents the model behind the search form about `backend\modules\mrp\models\Clavepresupuestal`.
 */
class ClavepresupuestalSearch extends Clavepresupuestal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['clavepresupuestal', 'descripcion'], 'safe'],
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
        $query = Clavepresupuestal::find();

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
        ]);

        $query->andFilterWhere(['like', 'clavepresupuestal', $this->clavepresupuestal])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
