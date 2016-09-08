<?php

namespace backend\modules\mrp\models;

//use Yii;

/**
 * This is the model class for table "tipoproveedores".
 *
 * @property integer $id
 * @property string $tipoproveedor
 *
 * @property Proveedores[] $proveedores
 */
class Tipoproveedores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoproveedores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipoproveedor'], 'required'],
            [['tipoproveedor'], 'string', 'max' => 100],
            [['tipoproveedor'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipoproveedor' => 'Tipo de Proveedor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedores()
    {
        return $this->hasMany(Proveedores::className(), ['tipoproveedor_id' => 'id']);
    }

    /* Validando los datos antes de ser guardados en la BD*/
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Manteniendo la información del catálogo en mayúsculas
            $this->tipoproveedor = trim(strtoupper($this->tipoproveedor));
            return true;
        }
        return false;
    }
}
