<?php

namespace backend\modules\caja\models;

//use Yii;

/**
 * This is the model class for table "arqueo".
 *
 * @property integer $id
 * @property string $username
 * @property string $farqueo
 * @property string $montoadeudo
 * @property string $montoapertura
 * @property string $montocierre
 * @property string $montoingreso
 * @property string $montoegreso
 * @property string $montoretiro
 * @property integer $liquidoadeudo
 * @property string $comentario
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['farqueo'], 'safe'],
            [['montoadeudo', 'montoapertura', 'montocierre', 'montoingreso', 'montoegreso', 'montoretiro'], 'number'],
            [['liquidoadeudo'], 'integer'],
            [['comentario'], 'string'],
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
            'username' => 'Username',
            'farqueo' => 'Farqueo',
            'montoadeudo' => 'Montoadeudo',
            'montoapertura' => 'Montoapertura',
            'montocierre' => 'Montocierre',
            'montoingreso' => 'Montoingreso',
            'montoegreso' => 'Montoegreso',
            'montoretiro' => 'Montoretiro',
            'liquidoadeudo' => 'Liquidoadeudo',
            'comentario' => 'Comentario',
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