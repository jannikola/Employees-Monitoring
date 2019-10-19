<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

namespace app\models\search;


use app\models\Arrival;
use yii\data\ActiveDataProvider;

class ArrivalSearch extends Arrival
{
    public function rules()
    {
        return [
            [['id', 'is_deleted'], 'integer'],
            [['employee_id', 'date', 'time', 'employee_id', 'is_late', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Arrival::find()
            ->innerJoinWith('employee');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [10, 10]
            ],
            'sort' => [
                'defaultOrder' => [
                    "id" => SORT_DESC
                ],
                'attributes' => [
                    'id',
                    'date',
                    'time',
                    'employee_id' => [
                        'asc' => ['employee.first_name' => SORT_ASC, 'employee.last_name' => SORT_ASC],
                        'desc' => ['employee.first_name' => SORT_DESC, 'employee.last_name' => SORT_DESC],
                    ],
                    'is_late'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'employee.first_name', $this->employee_id]);
        $query->orFilterWhere(['like', 'employee.last_name', $this->employee_id]);

        return $dataProvider;
    }

}