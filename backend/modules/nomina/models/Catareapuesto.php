<?php

namespace backend\modules\nomina\models;
/**
 * This is the model class for table "catareapuesto".
 *
 * @property integer $id
 * @property string $area
 *
 * @property Catpuestos[] $catpuestos
 */
class Catareapuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catareapuesto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area'], 'required'],
            [['area'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Area',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatpuestos()
    {
        return $this->hasMany(Catpuestos::className(), ['area_id' => 'id']);
    }
}
