<?php

namespace backend\modules\nomina\models;

use Yii;

/**
 * This is the model class for table "temporalidad_pago".
 *
 * @property int $id
 * @property string $temporalidad
 * @property string $multiplicador
 *
 * @property Colaboradores[] $colaboradores
 * @property FechasPago[] $fechasPagos
 */
class TemporalidadPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temporalidad_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['multiplicador'], 'number'],
            [['temporalidad'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'temporalidad' => 'Temporalidad',
            'multiplicador' => 'Multiplicador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColaboradores()
    {
        return $this->hasMany(Colaboradores::className(), ['temporalidad_pago_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFechasPagos()
    {
        return $this->hasMany(FechasPago::className(), ['temporalidad_pago_id' => 'id']);
    }
}
