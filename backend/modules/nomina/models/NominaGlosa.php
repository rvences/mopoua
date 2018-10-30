<?php

namespace backend\modules\nomina\models;

use Yii;

/**
 * This is the model class for table "nomina_glosa".
 *
 * @property int $id
 * @property int $colaborador_id
 * @property int $puesto_id
 * @property string $tipo_movimiento
 * @property string $percepcion
 * @property string $deduccion
 * @property string $pk
 * @property string $creditos
 * @property int $created_at
 * @property string $verificador
 * @property int $fechas_pago_id
 * @property string $concepto
 *
 * @property MovimientoDiario[] $movimientoDiarios
 * @property Colaboradores $colaborador
 * @property FechasPago $fechasPago
 */
class NominaGlosa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomina_glosa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['colaborador_id', 'puesto_id', 'created_at', 'fechas_pago_id'], 'integer'],
            [['percepcion', 'deduccion', 'pk', 'creditos'], 'number'],
            [['created_at', 'fechas_pago_id'], 'required'],
            [['tipo_movimiento'], 'string', 'max' => 10],
            [['verificador'], 'string', 'max' => 3],
            [['concepto'], 'string', 'max' => 100],
            [['colaborador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colaboradores::className(), 'targetAttribute' => ['colaborador_id' => 'id']],
            [['fechas_pago_id'], 'exist', 'skipOnError' => true, 'targetClass' => FechasPago::className(), 'targetAttribute' => ['fechas_pago_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'colaborador_id' => 'Colaborador ID',
            'puesto_id' => 'Puesto ID',
            'tipo_movimiento' => 'Tipo Movimiento',
            'percepcion' => 'Percepcion',
            'deduccion' => 'Deduccion',
            'pk' => 'Pk',
            'creditos' => 'Creditos',
            'created_at' => 'Created At',
            'verificador' => 'Verificador',
            'fechas_pago_id' => 'Fechas Pago ID',
            'concepto' => 'Concepto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoDiarios()
    {
        return $this->hasMany(MovimientoDiario::className(), ['nomina_glosa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColaborador()
    {
        return $this->hasOne(Colaboradores::className(), ['id' => 'colaborador_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFechasPago()
    {
        return $this->hasOne(FechasPago::className(), ['id' => 'fechas_pago_id']);
    }
}
