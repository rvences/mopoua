<?php

namespace backend\modules\nomina\models;

use Yii;

/**
 * This is the model class for table "nomina".
 *
 * @property int $id
 * @property int $fecha_pago_id
 * @property string $salario_neto
 * @property string $colaborador_id
 * @property string $colaborador
 * @property int $puesto_id
 * @property string $puesto
 * @property string $forma_pago
 * @property int $created_by
 * @property int $created_at
 */
class Nomina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomina';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_pago_id', 'puesto_id', 'created_by', 'created_at'], 'integer'],
            [['salario_neto', 'colaborador_id'], 'number'],
            [['colaborador'], 'string', 'max' => 200],
            [['puesto'], 'string', 'max' => 50],
            [['forma_pago'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_pago_id' => 'Fecha Pago ID',
            'salario_neto' => 'Salario Neto',
            'colaborador_id' => 'Colaborador ID',
            'colaborador' => 'Colaborador',
            'puesto_id' => 'Puesto ID',
            'puesto' => 'Puesto',
            'forma_pago' => 'Forma Pago',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }
}
