<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EfProject;

/**
 * EfProjectSearch represents the model behind the search form about `app\models\EfProject`.
 */
class EfProjectSearch extends EfProject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJECT_ID', 'PROJECT_TYPE_ID', 'UNIT_ID', 'DIVISION_ID', 'BUDGET_TYPE_ID', 'PROJ_HDLR_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['FISCAL_YEAR', 'PLAN_NAME', 'MAIN_PRODUCTIVITY', 'PROJECT_NAME', 'START_DATE', 'END_DATE', 'PROJECT_STATUS', 'CONTRACT_NUM', 'PLACE', 'AMPHOE_CODE', 'PROVINCE_CODE', 'PRINC_N_REASON', 'OBJECTIVE', 'TARGET', 'TARGET_GROUP', 'OUTPUT', 'INDICATOR', 'RESULT', 'SCOPE', 'PLAN', 'CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['BUDGET_RECEIVE', 'BUDGET_ACTUAL'], 'number'],
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
        $query = EfProject::find();

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
            'PROJECT_ID' => $this->PROJECT_ID,
            'PROJECT_TYPE_ID' => $this->PROJECT_TYPE_ID,
            'UNIT_ID' => $this->UNIT_ID,
            'DIVISION_ID' => $this->DIVISION_ID,
            'START_DATE' => $this->START_DATE,
            'END_DATE' => $this->END_DATE,
            'BUDGET_TYPE_ID' => $this->BUDGET_TYPE_ID,
            'BUDGET_RECEIVE' => $this->BUDGET_RECEIVE,
            'BUDGET_ACTUAL' => $this->BUDGET_ACTUAL,
            'PROJ_HDLR_ID' => $this->PROJ_HDLR_ID,
            'CREATE_BY' => $this->CREATE_BY,
            'CREATE_DATE' => $this->CREATE_DATE,
            'LAST_UPD_BY' => $this->LAST_UPD_BY,
            'LAST_UPD_DATE' => $this->LAST_UPD_DATE,
        ]);

        $query->andFilterWhere(['like', 'FISCAL_YEAR', $this->FISCAL_YEAR])
            ->andFilterWhere(['like', 'PLAN_NAME', $this->PLAN_NAME])
            ->andFilterWhere(['like', 'MAIN_PRODUCTIVITY', $this->MAIN_PRODUCTIVITY])
            ->andFilterWhere(['like', 'PROJECT_NAME', $this->PROJECT_NAME])
            ->andFilterWhere(['like', 'PROJECT_STATUS', $this->PROJECT_STATUS])
            ->andFilterWhere(['like', 'CONTRACT_NUM', $this->CONTRACT_NUM])
            ->andFilterWhere(['like', 'PLACE', $this->PLACE])
            ->andFilterWhere(['like', 'AMPHOE_CODE', $this->AMPHOE_CODE])
            ->andFilterWhere(['like', 'PROVINCE_CODE', $this->PROVINCE_CODE])
            ->andFilterWhere(['like', 'PRINC_N_REASON', $this->PRINC_N_REASON])
            ->andFilterWhere(['like', 'OBJECTIVE', $this->OBJECTIVE])
            ->andFilterWhere(['like', 'TARGET', $this->TARGET])
            ->andFilterWhere(['like', 'TARGET_GROUP', $this->TARGET_GROUP])
            ->andFilterWhere(['like', 'OUTPUT', $this->OUTPUT])
            ->andFilterWhere(['like', 'INDICATOR', $this->INDICATOR])
            ->andFilterWhere(['like', 'RESULT', $this->RESULT])
            ->andFilterWhere(['like', 'SCOPE', $this->SCOPE])
            ->andFilterWhere(['like', 'PLAN', $this->PLAN]);

        return $dataProvider;
    }
}
