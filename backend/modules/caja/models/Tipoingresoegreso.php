<?php

namespace backend\modules\caja\models;

//use Yii;

/**
 * This is the model class for table "tipoingresoegreso".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $descripcion
 */
class Tipoingresoegreso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoingresoegreso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'descripcion'], 'required'],
            [['tipo'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 100],
            [['descripcion'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'descripcion' => 'Descripcion',
        ];
    }
}
