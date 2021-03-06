<?php

namespace backend\modules\nomina\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "nompercepciondeduccion".
 *
 * @property int $id
 * @property int $puesto_id
 * @property string $clave_tipopd
 * @property string $monto
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Catpuestos $puesto
 * @property Cattipopd $claveTipopd
 */
class Nompercepciondeduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nompercepciondeduccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['puesto_id', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['monto'], 'number'],
            [['clave_tipopd'], 'string', 'max' => 10],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['puesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catpuestos::className(), 'targetAttribute' => ['puesto_id' => 'id']],
            [['clave_tipopd'], 'exist', 'skipOnError' => true, 'targetClass' => Cattipopd::className(), 'targetAttribute' => ['clave_tipopd' => 'clave']],
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
            'puesto_id' => 'Puesto ID',
            'clave_tipopd' => 'Clave Tipopd',
            'monto' => 'Monto',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
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
    public function getPuesto()
    {
        return $this->hasOne(Catpuestos::className(), ['id' => 'puesto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaveTipopd()
    {
        return $this->hasOne(Cattipopd::className(), ['clave' => 'clave_tipopd']);
    }
}
