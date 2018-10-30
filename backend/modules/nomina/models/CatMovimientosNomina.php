<?php

namespace backend\modules\nomina\models;

use Yii;

/**
 * This is the model class for table "cat_movimientos_nomina".
 *
 * @property int $id
 * @property string $clave
 * @property string $movimiento
 * @property string $descripcion
 *
 * @property MovimientoDiario[] $movimientoDiarios
 */
class CatMovimientosNomina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_movimientos_nomina';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave'], 'string', 'max' => 2],
            [['movimiento', 'descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave',
            'movimiento' => 'Movimiento',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoDiarios()
    {
        return $this->hasMany(MovimientoDiario::className(), ['movimiento_nomina_id' => 'id']);
    }
}
