<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property integer $id
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 */
class About extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
