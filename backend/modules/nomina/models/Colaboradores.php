<?php

namespace backend\modules\nomina\models;
use common\models\User;

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
 * @property User[] $users
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
        /*
        parent::afterSave($insert, $changedAttributes);
        $name = $this->user->name;
        $serial = ?
    $to = $this->user->email;
    $subject = 'new damage';
    $body = 'mr'.$name.'your damage with serial number'.$serial.'is registered';
    if ($insert) {

        App::sendMail($to, $subject, $body);
    }*/
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
