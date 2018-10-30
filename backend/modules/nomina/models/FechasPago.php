<?php

namespace backend\modules\nomina\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "fechas_pago".
 *
 * @property int $id
 * @property string $de
 * @property string $hasta
 * @property int $total_dias
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $fecha_pago
 * @property int $temporalidad_pago_id
 * @property int $estado_proceso
 *
 * @property TemporalidadPago $temporalidadPago
 * @property User $createdBy
 * @property User $updatedBy
 * @property NominaGlosa[] $nominaGlosas
 */
class FechasPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fechas_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_dias', 'created_at', 'updated_at', 'created_by', 'updated_by', 'fecha_pago', 'temporalidad_pago_id', 'estado_proceso'], 'integer'],
            [['de', 'hasta','temporalidad_pago_id'], 'required'],
            [['temporalidad_pago_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemporalidadPago::className(), 'targetAttribute' => ['temporalidad_pago_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],



        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'de' => 'De',
            'hasta' => 'Hasta',
            'total_dias' => 'Total Dias',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'fecha_pago' => 'Fecha en que se pagó',
            'temporalidad_pago_id' => 'Temporalidad de Pago',
            'estado_proceso' => 'Estado de la nomina',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemporalidadPago()
    {
        return $this->hasOne(TemporalidadPago::className(), ['id' => 'temporalidad_pago_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNominaGlosas()
    {
        return $this->hasMany(NominaGlosa::className(), ['fechas_pago_id' => 'id']);
    }

    public static function EstadoNomina() {
        //  0   Sin Procesar
        //  1   Solicitado  --  Lo solicita el usuario y se bloquea para edición
        //  2   En Proceso  --  Se inicia el proceso en el CRON
        //  9   Procesado   --  CRON finalizado
        return [
            ['id' => 0, 'estado' => 'Sin Procesar'],
            ['id' => 1, 'estado' => 'Solicitado'],
            ['id' => 2, 'estado' => 'En Proceso'],
            ['id' => 9, 'estado' => 'Procesado'],
        ];
    }

    public function getEstados($dato) {
        foreach ( self::EstadoNomina() as $key => $valor) {
            if ($valor['id'] == $dato) {
                return $valor['estado'];
            }
        }
        return '';
    }


}
