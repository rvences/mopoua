<?php

namespace backend\modules\mrp\models;

//use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property integer $id
 * @property string $nombre_corto
 * @property integer $tipoproveedor_id
 * @property string $razon_social
 * @property string $contacto
 * @property string $telefono
 * @property string $rfc
 * @property string $correo
 * @property string $notas
 * @property string $clabe
 * @property string $cuenta
 * @property string $banco
 * @property string $cliente
 * @property integer $paga_cajero
 *
 * @property Tipoproveedores $tipoproveedor
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_corto', 'tipoproveedor_id', 'razon_social'], 'required'],
            [['tipoproveedor_id', 'paga_cajero'], 'integer'],
            [['notas'], 'string'],
            [['nombre_corto', 'clabe', 'banco', 'cliente'], 'string', 'max' => 20],
            [['razon_social', 'contacto', 'correo'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 15],
            [['rfc'], 'string', 'max' => 13],
            [['cuenta'], 'string', 'max' => 30],
            [['razon_social'], 'unique'],
            [['tipoproveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoproveedores::className(), 'targetAttribute' => ['tipoproveedor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_corto' => 'Como se conoce al proveedor',
            'tipoproveedor_id' => 'Tipo de Proveedor',
            'razon_social' => 'Nombre del Proveedor',
            'contacto' => 'Vendedor',
            'telefono' => 'Telefono de Contacto',
            'rfc' => 'RFC del Proveedor',
            'correo' => 'Correo del Proveedor',
            'notas' => 'Temas importantes',
            'clabe' => 'Clave InterBancaria',
            'cuenta' => 'Número de Cuenta',
            'banco' => 'Nombre del Banco',
            'cliente' => 'Número de Cliente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoproveedor()
    {
        return $this->hasOne(Tipoproveedores::className(), ['id' => 'tipoproveedor_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->nombre_corto = trim(strtoupper($this->nombre_corto));
            $this->razon_social = trim(strtoupper($this->razon_social));
            $this->rfc = trim(strtoupper($this->rfc));
            return true;
        }
        return false;
    }
}
