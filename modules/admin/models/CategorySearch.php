<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\modules\admin\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'status', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //Alteraçao do numero de registros a ser exibidos na GridView()
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //faz tratamento nos atributos, transformando de Timestamp para o tipo date
            'FROM_UNIXTIME(created_at, \'%d/%m/%Y\')' => $this->created_at,
            'FROM_UNIXTIME(updated_at, \'%d/%m/%Y\')' => $this->updated_at,
            'status' => $this->status
        ]);


        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
