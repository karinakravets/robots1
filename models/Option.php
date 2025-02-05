<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option".
 *
 * @property int $id
 * @property int $platform_id
 * @property int $category_id
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['platform_id', 'category_id'], 'required'],
            [['platform_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'platform_id' => 'Платформа',
            'category_id' => 'Категория',
        ];
    }

    public static function get() {
        return static::findOne(1);
    }
}
