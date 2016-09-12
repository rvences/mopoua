<?php

namespace backend\modules\mrp\models;

//use Yii;

/**
 * This is the model class for table "insumo".
 *
 * @property integer $id
 * @property integer $clavepresupuestal_id
 * @property string $insumo_generico
 * @property integer $unidad_id
 *
 * @property Clavepresupuestal $clavepresupuestal
 * @property Unidadmedida $unidad
 * @property Presentacion[] $presentacions
 */
class Insumo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insumo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clavepresupuestal_id', 'insumo_generico', 'unidad_id'], 'required'],
            [['clavepresupuestal_id', 'unidad_id'], 'integer'],
            [['insumo_generico'], 'string', 'max' => 100],
            [['clavepresupuestal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clavepresupuestal::className(), 'targetAttribute' => ['clavepresupuestal_id' => 'id']],
            [['unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unidadmedida::className(), 'targetAttribute' => ['unidad_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clavepresupuestal_id' => 'Clave Presupuestal',
            'insumo_generico' => 'Nombre del Insumo',
            'unidad_id' => 'Unidad Mínima Medida',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClavepresupuestal()
    {
        return $this->hasOne(Clavepresupuestal::className(), ['id' => 'clavepresupuestal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidad()
    {
        return $this->hasOne(Unidadmedida::className(), ['id' => 'unidad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacions()
    {
        return $this->hasMany(Presentacion::className(), ['insumo_id' => 'id']);
    }
}
