<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EfProjectPlanAct;

/**
 * EfProjectPlanActSearch represents the model behind the search form about `app\models\EfProjectPlanAct`.
 */
class EfProjectPlanActSearch extends EfProjectPlanAct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJECT_PLAN_ACT_ID', 'LEVEL', 'PARENT_ID', 'PROJECT_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['PLAN_ACT_NAME', 'SEQ', 'STATUS', 'CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['BUDGET_PLAN'], 'number'],
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
        $query = EfProjectPlanAct::find();

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
            'PROJECT_PLAN_ACT_ID' => $this->PROJECT_PLAN_ACT_ID,
            'BUDGET_PLAN' => $this->BUDGET_PLAN,
            'LEVEL' => $this->LEVEL,
            'PARENT_ID' => $this->PARENT_ID,
            'PROJECT_ID' => $this->PROJECT_ID,
            'CREATE_BY' => $this->CREATE_BY,
            'CREATE_DATE' => $this->CREATE_DATE,
            'LAST_UPD_BY' => $this->LAST_UPD_BY,
            'LAST_UPD_DATE' => $this->LAST_UPD_DATE,
        ]);

        $query->andFilterWhere(['like', 'PLAN_ACT_NAME', $this->PLAN_ACT_NAME])
            ->andFilterWhere(['like', 'SEQ', $this->SEQ])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS]);

        return $dataProvider;
    }
}
