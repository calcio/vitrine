<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Products[] $products
 */
class Category extends yii\db\ActiveRecord
{
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_INACTIVE = 0;
    CONST STATUS_ACTIVE_STRING = 'Active';
    CONST STATUS_INACTIVE_STRING = 'Inactive';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 80],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    public function getStatusItems()
    {
        return [
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_STRING,
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_STRING,
        ];
    }

    public function getAllCategories()
    {
        return Category::find()
                    ->select('id, name')
                    ->where(['status' => self::STATUS_ACTIVE])
                    ->orderBy('name')
                    ->all();
    }

    public function getAllCategoriesAsArray()
    {
        return ArrayHelper::map($this->getAllCategories(), 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
}

