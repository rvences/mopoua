<?php

namespace backend\modules\nomina\models;
use common\models\User;

/**
 * This is the model class for table "colaboradores".
 *
 * @property int $id
 * @property string $clave Clave del Colaborador
 * @property string $nombre Nombre(s)
 * @property string $apaterno Ap. Paterno
 * @property string $amaterno Ap. Materno
 * @property string $rfc RFC
 * @property string $curp CURP
 * @property string $nss Número Seguro Social
 * @property int $puesto_id Identificador del puesto
 * @property string $fingreso
 * @property string $fbaja
 * @property int $activo
 * @property int $temporalidad_pago_id
 * @property string $telefono
 * @property string $emergencia_contacto
 * @property string $emergencia_telefono
 * @property string $forma_pago
 * @property string $numero_cuenta
 * @property string $observaciones
 *
 * @property TemporalidadPago $temporalidadPago
 * @property Catpuestos $puesto
 * @property MovimientoDiario[] $movimientoDiarios
 * @property MovimientoDiario[] $movimientoDiarios0
 * @property NominaGlosa[] $nominaGlosas
 * @property Tareas[] $tareas
 * @property Tareas[] $tareas0
 * @property Tareas[] $tareas1
 * @property User[] $users
 */
class Colaboradores extends \yii\db\ActiveRecord
{
    public $bcolaborador_nombre;
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
            [['clave', 'nombre', 'apaterno', 'amaterno', 'puesto_id', 'activo', 'temporalidad_pago_id'], 'required'],
            [['puesto_id', 'activo', 'temporalidad_pago_id'], 'integer'],
            [['fingreso', 'fbaja'], 'safe'],
            [['observaciones'], 'string'],
            [['clave', 'telefono', 'emergencia_telefono', 'forma_pago'], 'string', 'max' => 10],
            [['nombre', 'emergencia_contacto'], 'string', 'max' => 100],
            [['apaterno', 'amaterno'], 'string', 'max' => 32],
            [['rfc'], 'string', 'max' => 13],
            [['curp', 'numero_cuenta'], 'string', 'max' => 18],
            [['nss'], 'string', 'max' => 11],
            [['clave'], 'unique'],
            [['temporalidad_pago_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemporalidadPago::className(), 'targetAttribute' => ['temporalidad_pago_id' => 'id']],
            [['puesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catpuestos::className(), 'targetAttribute' => ['puesto_id' => 'id']],

            [['nombre', 'apaterno', 'amaterno', 'rfc', 'curp', 'nss'], 'filter', 'filter' => 'strtoupper'],

        ];

    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave dispositivo biométrico',
            'nombre' => 'Nombre',
            'apaterno' => 'Apellido paterno',
            'amaterno' => 'Apellido materno',
            'rfc' => 'RFC',
            'curp' => 'CURP',
            'nss' => 'Número de Seguro Social',
            'puesto_id' => 'Puesto Actual',
            'fingreso' => 'Fecha de Ingreso',
            'fbaja' => 'Fecha de Baja',
            'activo' => 'Activo',
            'temporalidad_pago_id' => 'Temporalidad de Pago',
            'bcolaborador_nombre' => 'Colaborador',
            'telefono' => 'Telefono',
            'emergencia_contacto' => 'Emergencia Contacto',
            'emergencia_telefono' => 'Emergencia Telefono',
            'forma_pago' => 'Forma Pago',
            'numero_cuenta' => 'Numero Cuenta',
            'observaciones' => 'Observaciones',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            /*
            if ($this->isNewRecord) {
                $usuario = new User();
                $usuario->username = strtolower(substr($this->nombre, 0, 1) . $this->apaterno . substr($this->amaterno, 0, 1)) ;
                $usuario->auth_key = 'RjwwBJFBEWPsRsj9oCcgivVErTFegjfm';
                $usuario->password_hash = '$2y$13$qCG9wSmSRq6C0FEMdU9pbeZWfYkwkXrSVG3boHf5Nv3dsbI4km9My';
                $usuario->email = $usuario->username . '@pkory.com';
                $usuario->status = 10;
                $usuario->role = 'CAJA';
                $usuario->colaborador_id = $this->id;
                $usuario->save('true');

            }
            */
            $this->nombre = trim(strtoupper($this->nombre));
            $this->apaterno = trim(strtoupper($this->apaterno));
            $this->amaterno = trim(strtoupper($this->amaterno));
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $usuario = new User();
            $usuario->username = strtolower(substr($this->nombre, 0, 1) . $this->apaterno . substr($this->amaterno, 0, 1)) ;
            $usuario->auth_key = 'RjwwBJFBEWPsRsj9oCcgivVErTFegjfm';
            $usuario->password_hash = '$2y$13$qCG9wSmSRq6C0FEMdU9pbeZWfYkwkXrSVG3boHf5Nv3dsbI4km9My';
            $usuario->email = $usuario->username . '@pkory.com';
            $usuario->status = 10;
            $usuario->role = 'CAJA';
            $usuario->colaborador_id = $this->id;
            $usuario->save('true');
        }
}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemporalidadPago()
    {
        return $this->hasOne(TemporalidadPago::className(), ['id' => 'temporalidad_pago_id']);
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
    public function getMovimientoDiarios()
    {
        return $this->hasMany(MovimientoDiario::className(), ['colaborador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoDiarios0()
    {
        return $this->hasMany(MovimientoDiario::className(), ['colaborador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNominaGlosas()
    {
        return $this->hasMany(NominaGlosa::className(), ['colaborador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas()
    {
        return $this->hasMany(Tareas::className(), ['user_solicita_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas0()
    {
        return $this->hasMany(Tareas::className(), ['user_realizo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas1()
    {
        return $this->hasMany(Tareas::className(), ['asignado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['colaborador_id' => 'id']);
    }

    /*
     * Obtiene el listado de los colaboradores de acuerdo al área laboral asignada
     * */
    public static function listUserActive($arealaboral = 0) {

        if ($arealaboral == 0) {
            return Colaboradores::find()->select(['colaboradores.id', 'nombre', 'apaterno', 'amaterno'])->where(['fbaja' => null])->orderBy('nombre, apaterno')->all();
        }
        //return Colaboradores::find()->select(['colaboradores.id', 'nombre', 'apaterno', 'amaterno'])->joinWith('puesto')->where(['fbaja' => null, 'area_id' => $arealaboral])->orderBy('nombre, apaterno')->all();

        return Colaboradores::find()->select(['colaboradores.id', 'nombre', 'apaterno', 'amaterno'])->joinWith('puesto')->where(['fbaja' => null, 'area_id' => $arealaboral])->union('SELECT colaboradores.id, nombre, apaterno, amaterno FROM colaboradores WHERE nombre ="RAFAEL KORY"')->orderBy('nombre, apaterno')->all();

    }


    /*
     * Obtiene un Array de los usuarios de un área laboral específica
     */
    public static function getUsersId($arealaboral = 0) {

        if ($arealaboral == 0) {
            return Colaboradores::find()->select(['colaboradores.id'])->where(['fbaja' => null])->orderBy('nombre, apaterno')->all();
        }
//        return Colaboradores::find()->select(['colaboradores.id'])->joinWith('puesto')->where(['fbaja' => null, 'area_id' => $arealaboral])->all();

        $valor = Colaboradores::find()->select(['colaboradores.id'])->all();

        $valor = Colaboradores::find()->select('id')->all();

            return $valor;
        //print_r( Colaboradores::find()->select(['colaboradores.id'])->asArray()->all());
//return ['112'];
        //return Colaboradores::find()->select('colaboradores.id')->joinWith('puesto')->where(['fbaja' => null, 'area_id' => $arealaboral])->asArray()->all();
    }


    public function getNombrecompleto() {
        return $this->nombre . ' ' . $this->apaterno . ' ' . $this->amaterno;
    }

}
