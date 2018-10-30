<?php

namespace backend\modules\nomina\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use common\models\User;
/**
 * This is the model class for table "movimiento_diario".
 *
 * @property int $id
 * @property int $colaborador_id
 * @property string $movimiento_fecha
 * @property int $movimiento_nomina_id
 * @property string $movimiento_nomina_info
 * @property string $monto
 * @property int $aplicado_en_nomina
 * @property int $nomina_glosa_id
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Colaboradores $colaborador
 * @property Colaboradores $colaborador0
 * @property CatMovimientosNomina $movimientoNomina
 * @property NominaGlosa $nominaGlosa
 * @property User $createdBy
 */
class MovimientoDiario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movimiento_diario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['colaborador_id', 'movimiento_nomina_id', 'aplicado_en_nomina', 'nomina_glosa_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['movimiento_fecha'], 'safe'],
            [['monto'], 'number'],
            [['movimiento_nomina_info'], 'string', 'max' => 100],
            [['colaborador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colaboradores::className(), 'targetAttribute' => ['colaborador_id' => 'id']],
            [['colaborador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colaboradores::className(), 'targetAttribute' => ['colaborador_id' => 'id']],
            [['movimiento_nomina_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatMovimientosNomina::className(), 'targetAttribute' => ['movimiento_nomina_id' => 'id']],
            [['nomina_glosa_id'], 'exist', 'skipOnError' => true, 'targetClass' => NominaGlosa::className(), 'targetAttribute' => ['nomina_glosa_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
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
            'colaborador_id' => 'Colaborador ID',
            'movimiento_fecha' => 'Movimiento Fecha',
            'movimiento_nomina_id' => 'Movimiento Nomina ID',
            'movimiento_nomina_info' => 'Movimiento Nomina Info',
            'monto' => 'Monto',
            'aplicado_en_nomina' => 'Aplicado En Nomina',
            'nomina_glosa_id' => 'Nomina Glosa ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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
    public function getColaborador0()
    {
        return $this->hasOne(Colaboradores::className(), ['id' => 'colaborador_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoNomina()
    {
        return $this->hasOne(CatMovimientosNomina::className(), ['id' => 'movimiento_nomina_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNominaGlosa()
    {
        return $this->hasOne(NominaGlosa::className(), ['id' => 'nomina_glosa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}

