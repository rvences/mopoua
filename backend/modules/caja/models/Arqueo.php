<?php

namespace backend\modules\caja\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "arqueo".
 *
 * @property integer $id
 * @property string $username
 * @property string $farqueo
 * @property string $comentario
 * @property string $efectivoapertura
 * @property string $efectivocierre
 * @property string $efectivosistema
 * @property string $dineroelectronico
 * @property string $efectivoadeudoanterior
 * @property string $depositoempresa
 * @property string $retiroempresa
 * @property string $egresocompras
 * @property string $egresocomprasservicio
 * @property string $efectivofisico
 * @property string $adeudoanterior
 * @property string $adeudoactual
 * @property string $ventaturno
 * @property string $egresoturno
 * @property integer $cerrado
 *
 * @property Conteodiario[] $conteodiarios
 * @property Conteonotas[] $conteonotas
 */
class Arqueo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'arqueo';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['farqueo'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['farqueo'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'default', 'value' =>  Yii::$app->user->identity->username],
            [['farqueo'], 'safe'],
            [['comentario'], 'string'],
            [['cerrado'], 'integer'],
            [['efectivoapertura', 'efectivocierre', 'efectivosistema', 'dineroelectronico', 'efectivoadeudoanterior', 'depositoempresa', 'retiroempresa', 'egresocompras', 'egresocomprasservicio', 'efectivofisico', 'adeudoanterior', 'adeudoactual', 'ventaturno', 'egresoturno'], 'number'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'farqueo' => 'Fecha del Arqueo',
            'comentario' => 'Eventualidad que provoque error en arqueo',
            'efectivoapertura' => 'Efectivo inicial',
            'efectivocierre' => 'Efectivo al cierre',
            'efectivosistema' => 'Efectivo reportado por el sistema',
            'dineroelectronico' => 'Pagos con Tarjeta y/o Firmas',
            'efectivoadeudoanterior' => 'Adeudo día Anterior',
            'depositoempresa' => 'Depósito adicional por la Empresa',
            'retiroempresa' => 'Retiro de efectivo por la Empresa',
            'egresocompras' => 'Compras pagadas de la caja',
            'egresocomprasservicio' => 'Servicios pagados de la caja',
            'efectivofisico' => 'Efectivo que debe de existir en la caja',
            'adeudoanterior' => 'Cuanto quedo a deber el cajero el día anterior',
            'adeudoactual' => 'Dinero que quedo a deber el cajero',
            'ventaturno' => 'Cuanto se vendio en el turno',
            'egresoturno' => 'Cuando se gasto en el turno',
            'cerrado' => 'Turno cerrado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConteodiarios()
    {
        return $this->hasMany(Conteodiario::className(), ['arqueo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConteonotas()
    {
        return $this->hasMany(Conteonotas::className(), ['arqueo_id' => 'id']);
    }
}
