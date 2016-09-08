<?php

namespace backend\modules\mrp\models\search;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\mrp\models\Proveedores;

/**
 * ProveedoresSearch represents the model behind the search form about `backend\modules\mrp\models\Proveedores`.
 */
class ProveedoresSearch extends Proveedores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipoproveedor_id'], 'integer'],
            [['nombre_corto', 'razon_social', 'contacto', 'telefono', 'rfc', 'correo', 'notas', 'clabe', 'cuenta', 'banco', 'cliente'], 'safe'],
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
        $query = Proveedores::find();

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
            'tipoproveedor_id' => $this->tipoproveedor_id,
        ]);

        $query->andFilterWhere(['like', 'nombre_corto', $this->nombre_corto])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'contacto', $this->contacto])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'rfc', $this->rfc])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'notas', $this->notas])
            ->andFilterWhere(['like', 'clabe', $this->clabe])
            ->andFilterWhere(['like', 'cuenta', $this->cuenta])
            ->andFilterWhere(['like', 'banco', $this->banco])
            ->andFilterWhere(['like', 'cliente', $this->cliente]);

        return $dataProvider;
    }
}
