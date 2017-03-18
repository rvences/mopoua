<?php

namespace backend\modules\nomina\models;

use Yii;

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
 * @property integer $puesto
 * @property string $tipo
 * @property integer $tabulador
 * @property string $fingreso
 * @property string $fbaja
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
            [['puesto', 'tabulador'], 'integer'],
            [['fingreso', 'fbaja'], 'safe'],
            [['clave'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 100],
            [['apaterno', 'amaterno'], 'string', 'max' => 32],
            [['rfc'], 'string', 'max' => 13],
            [['curp'], 'string', 'max' => 18],
            [['nss', 'tipo'], 'string', 'max' => 11],
            [['clave'], 'unique'],
            [['rfc'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave',
            'nombre' => 'Nombre',
            'apaterno' => 'Apaterno',
            'amaterno' => 'Amaterno',
            'rfc' => 'Rfc',
            'curp' => 'Curp',
            'nss' => 'Nss',
            'puesto' => 'Puesto',
            'tipo' => 'Tipo',
            'tabulador' => 'Tabulador',
            'fingreso' => 'Fingreso',
            'fbaja' => 'Fbaja',
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
