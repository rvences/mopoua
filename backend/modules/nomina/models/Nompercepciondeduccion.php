<?php

namespace backend\modules\nomina\models;

/**
 * This is the model class for table "nompercepciondeduccion".
 *
 * @property integer $id
 * @property integer $puesto_id
 * @property string $clave_tipopd
 * @property string $monto
 * @property string $created
 * @property string $updated
 *
 * @property Catpuestos $puesto
 * @property Cattipopd $claveTipopd
 */
class Nompercepciondeduccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nompercepciondeduccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['puesto_id'], 'integer'],
            [['monto'], 'number'],
            [['monto', 'clave_tipopd'], 'required'],
            [['created', 'updated'], 'safe'],
            [['clave_tipopd'], 'string', 'max' => 10],
            [['puesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catpuestos::className(), 'targetAttribute' => ['puesto_id' => 'id']],
            [['clave_tipopd'], 'exist', 'skipOnError' => true, 'targetClass' => Cattipopd::className(), 'targetAttribute' => ['clave_tipopd' => 'clave']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'puesto_id' => 'Puesto ID',
            'clave_tipopd' => 'Clave Tipopd',
            'monto' => 'Monto',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
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
