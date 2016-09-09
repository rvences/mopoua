<?php

namespace backend\modules\mrp\models;

//use Yii;

/**
 * This is the model class for table "clavepresupuestal".
 *
 * @property integer $id
 * @property string $clavepresupuestal
 * @property string $descripcion
 */
class Clavepresupuestal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clavepresupuestal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clavepresupuestal', 'descripcion'], 'required'],
            [['clavepresupuestal'], 'string', 'max' => 20],
            [['descripcion'], 'string', 'max' => 255],
            [['clavepresupuestal'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clavepresupuestal' => 'Clave Presupuestal',
            'descripcion' => 'Descripción',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->clavepresupuestal = trim(strtoupper($this->clavepresupuestal));
            return true;
        }
        return false;
    }
}
