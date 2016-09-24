<?php

namespace backend\modules\caja\models\search;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\caja\models\Conteodiario;

/**
 * ConteodiarioSearch represents the model behind the search form about `backend\modules\caja\models\Conteodiario`.
 */
class ConteodiarioSearch extends Conteodiario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'inal1', 'inal2', 'inal3', 'inal4', 'inal5', 'inal6', 'inal7', 'inal8', 'inal9', 'inal10', 'inal11', 'inal12', 'inal13', 'inal14', 'inal15', 'inal16', 'iext1', 'iext2', 'cnal1', 'cnal2', 'cnal3', 'cnal4', 'cnal5', 'cnal6', 'cnal7', 'cnal8', 'cnal9', 'cnal10', 'cnal11', 'cnal12', 'cnal13', 'cnal14', 'cnal15', 'cnal16', 'cext1', 'cext2', 'arqueo_id'], 'integer'],
            [['username', 'fapertura', 'fcierre'], 'safe'],
            [['montoapertura', 'montocierre'], 'number'],
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
        $query = Conteodiario::find();

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
            'inal1' => $this->inal1,
            'inal2' => $this->inal2,
            'inal3' => $this->inal3,
            'inal4' => $this->inal4,
            'inal5' => $this->inal5,
            'inal6' => $this->inal6,
            'inal7' => $this->inal7,
            'inal8' => $this->inal8,
            'inal9' => $this->inal9,
            'inal10' => $this->inal10,
            'inal11' => $this->inal11,
            'inal12' => $this->inal12,
            'inal13' => $this->inal13,
            'inal14' => $this->inal14,
            'inal15' => $this->inal15,
            'inal16' => $this->inal16,
            'iext1' => $this->iext1,
            'iext2' => $this->iext2,
            'fapertura' => $this->fapertura,
            'cnal1' => $this->cnal1,
            'cnal2' => $this->cnal2,
            'cnal3' => $this->cnal3,
            'cnal4' => $this->cnal4,
            'cnal5' => $this->cnal5,
            'cnal6' => $this->cnal6,
            'cnal7' => $this->cnal7,
            'cnal8' => $this->cnal8,
            'cnal9' => $this->cnal9,
            'cnal10' => $this->cnal10,
            'cnal11' => $this->cnal11,
            'cnal12' => $this->cnal12,
            'cnal13' => $this->cnal13,
            'cnal14' => $this->cnal14,
            'cnal15' => $this->cnal15,
            'cnal16' => $this->cnal16,
            'cext1' => $this->cext1,
            'cext2' => $this->cext2,
            'fcierre' => $this->fcierre,
            'montoapertura' => $this->montoapertura,
            'montocierre' => $this->montocierre,
            'arqueo_id' => $this->arqueo_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
