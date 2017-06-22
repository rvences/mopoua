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

    public function searchComplete($params)
    {
        // select cp.area_id, t.id, t.asignado_id, t.tarea, c.nombre, c.puesto_id from tareas as t join colaboradores as c on t.asignado_id = c.id join catpuestos as cp on cp.id = c.puesto_id where area_id=2;

        $area = Tareas::getAreaLaboral();
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT c.id as asignado_id
            FROM colaboradores AS c 
            JOIN catpuestos AS cp ON c.puesto_id = cp.id AND cp.area_id=:area', [':area' => $area['area_id']]);

        $subQuery = $command->queryAll();

        $query = Tareas::find()
            ->where(['IN', 'asignado_id', $subQuery]

            )->orderBy('fecha_limite');
            ;
        //$query = Tareas::find();

        //$query->orderBy('fecha_limite');


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
