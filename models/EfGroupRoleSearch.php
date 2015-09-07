<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EfGroupRole;

/**
 * EfGroupRoleSearch represents the model behind the search form about `app\models\EfGroupRole`.
 */
class EfGroupRoleSearch extends EfGroupRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GROUP_ROLE_ID', 'GROUP_ID', 'MENU_SUB_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['ACCESS_FLAG', 'ADD_FLAG', 'EDIT_FLAG', 'DELETE_FLAG', 'CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
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
        $query = EfGroupRole::find();

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
            'GROUP_ROLE_ID' => $this->GROUP_ROLE_ID,
            'GROUP_ID' => $this->GROUP_ID,
            'MENU_SUB_ID' => $this->MENU_SUB_ID,
            'CREATE_BY' => $this->CREATE_BY,
            'CREATE_DATE' => $this->CREATE_DATE,
            'LAST_UPD_BY' => $this->LAST_UPD_BY,
            'LAST_UPD_DATE' => $this->LAST_UPD_DATE,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_FLAG', $this->ACCESS_FLAG])
            ->andFilterWhere(['like', 'ADD_FLAG', $this->ADD_FLAG])
            ->andFilterWhere(['like', 'EDIT_FLAG', $this->EDIT_FLAG])
            ->andFilterWhere(['like', 'DELETE_FLAG', $this->DELETE_FLAG]);

        return $dataProvider;
    }
}
