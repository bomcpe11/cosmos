<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EfGroup;

/**
 * EfGroupSearch represents the model behind the search form about `app\models\EfGroup`.
 */
class EfGroupSearch extends EfGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GROUP_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['GROUP_NAME', 'STATUS', 'CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
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
        $query = EfGroup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'GROUP_ID' => $this->GROUP_ID,
            'CREATE_BY' => $this->CREATE_BY,
            'CREATE_DATE' => $this->CREATE_DATE,
            'LAST_UPD_BY' => $this->LAST_UPD_BY,
            'LAST_UPD_DATE' => $this->LAST_UPD_DATE,
        ]);

        $query->andFilterWhere(['like', 'GROUP_NAME', $this->GROUP_NAME])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

        return $dataProvider;
    }
}
