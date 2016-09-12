<?php

namespace backend\modules\mrp\models;

//use Yii;

/**
 * This is the model class for table "presentacion".
 *
 * @property integer $id
 * @property integer $insumo_id
 * @property string $insumo
 * @property string $marca
 * @property integer $presentacion
 * @property integer $presentacionunidad_id
 * @property integer $equivalencia
 * @property integer $equivalenciasunidad_id
 *
 * @property Insumo $insumo0
 * @property Unidadmedida $presentacionunidad
 * @property Unidadmedida $equivalenciasunidad
 */
class Presentacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insumo', 'marca', 'presentacion', 'presentacionunidad_id', 'equivalencia', 'equivalenciasunidad_id'], 'required'],
            [['insumo_id', 'presentacion', 'presentacionunidad_id', 'equivalencia', 'equivalenciasunidad_id'], 'integer'],
            [['insumo', 'marca'], 'string', 'max' => 100],
            [['insumo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Insumo::className(), 'targetAttribute' => ['insumo_id' => 'id']],
            [['presentacionunidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unidadmedida::className(), 'targetAttribute' => ['presentacionunidad_id' => 'id']],
            [['equivalenciasunidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unidadmedida::className(), 'targetAttribute' => ['equivalenciasunidad_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'insumo_id' => 'Insumo ID',
            'insumo' => 'Insumo',
            'marca' => 'Marca',
            'presentacion' => 'Presentación',
            'presentacionunidad_id' => 'Unidad de Presentación',
            'equivalencia' => 'Equivalencia',
            'equivalenciasunidad_id' => 'Unidad de Equivalencia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumo0()
    {
        return $this->hasOne(Insumo::className(), ['id' => 'insumo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacionunidad()
    {
        return $this->hasOne(Unidadmedida::className(), ['id' => 'presentacionunidad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquivalenciasunidad()
    {
        return $this->hasOne(Unidadmedida::className(), ['id' => 'equivalenciasunidad_id']);
    }
}
