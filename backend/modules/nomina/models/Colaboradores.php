<?php

namespace backend\modules\nomina\models;

/**
 * This is the model class for table "colaboradores".
 *
 * @property integer $id
 * @property string $clave
 * @property string $nombre
 * @property string $apaterno
 * @property string $amaterno
 * @property string $rfc
 * @property string $curp
 * @property string $nss
 * @property string $fingreso
 * @property string $fbaja
 * @property integer $puesto_id
 *
 * @property Catpuestos $puesto
 */
class Colaboradores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'colaboradores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clave', 'nombre', 'apaterno', 'amaterno'], 'required'],
            [['puesto_id'], 'integer'],
            [['fingreso', 'fbaja'], 'safe'],
            [['clave'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 100],
            [['apaterno', 'amaterno'], 'string', 'max' => 32],
            [['rfc'], 'string', 'max' => 13],
            [['curp'], 'string', 'max' => 18],
            [['nss'], 'string', 'max' => 11],
            [['clave'], 'unique'],
            [['rfc'], 'unique'],
            [['puesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catpuestos::className(), 'targetAttribute' => ['puesto_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave Biométrico',
            'nombre' => 'Nombre',
            'apaterno' => 'Apaterno',
            'amaterno' => 'Amaterno',
            'rfc' => 'Rfc',
            'curp' => 'Curp',
            'nss' => 'Nss',
            'puesto_id' => 'Puesto',
            'fingreso' => 'Ingreso',
            'fbaja' => 'Baja',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->nombre = trim(strtoupper($this->nombre));
            $this->apaterno = trim(strtoupper($this->apaterno));
            $this->amaterno = trim(strtoupper($this->amaterno));
            return true;
        }
        return false;
    }
}
