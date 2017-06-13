<?php

namespace backend\modules\productividad\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\productividad\models\Tareas;

/**
 * TareasSearch represents the model behind the search form about `backend\modules\productividad\models\Tareas`.
 */
class TareasSearch extends Tareas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'asignado_id', 'tipoactividad_id', 'estado_id', 'user_solicita_id', 'user_realizo_id'], 'integer'],
            [['tarea', 'resultado', 'fecha_limite', 'modified', 'created'], 'safe'],
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
        $query = Tareas::find();

        $query->orderBy('fecha_limite');


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
            'asignado_id' => $this->asignado_id,
            'tipoactividad_id' => $this->tipoactividad_id,
            'estado_id' => $this->estado_id,
            'fecha_limite' => $this->fecha_limite,
            'user_solicita_id' => $this->user_solicita_id,
            'modified' => $this->modified,
            'created' => $this->created,
            'user_realizo_id' => $this->user_realizo_id,
        ]);

        $query->andFilterWhere(['like', 'tarea', $this->tarea])
            ->andFilterWhere(['like', 'resultado', $this->resultado]);

        return $dataProvider;
    }
}
