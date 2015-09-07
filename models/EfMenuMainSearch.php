<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EfMenuMain;

/**
 * EfMenuMainSearch represents the model behind the search form about `app\models\EfMenuMain`.
 */
class EfMenuMainSearch extends EfMenuMain
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MENU_MAIN_ID', 'SEQ', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['MENU_MAIN_NAME', 'DESCRIPTION', 'STATUS', 'CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
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
        $query = EfMenuMain::find();

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
            'MENU_MAIN_ID' => $this->MENU_MAIN_ID,
            'SEQ' => $this->SEQ,
            'CREATE_BY' => $this->CREATE_BY,
            'CREATE_DATE' => $this->CREATE_DATE,
            'LAST_UPD_BY' => $this->LAST_UPD_BY,
            'LAST_UPD_DATE' => $this->LAST_UPD_DATE,
        ]);

        $query->andFilterWhere(['like', 'MENU_MAIN_NAME', $this->MENU_MAIN_NAME])
            ->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

        return $dataProvider;
    }
}
