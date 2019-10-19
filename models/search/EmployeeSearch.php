<?php

namespace app\models\search;

use app\models\Arrival;
use app\models\Employee;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */
class EmployeeSearch extends Employee
{
    public function rules()
    {
        return [
            [['id', 'is_deleted'], 'integer'],
            [['first_name', 'last_name', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Employee::find()
            ->select(['employee.id', 'first_name', 'last_name', 'late_arrival_count' => new Expression("SUM(arrival.is_late)")])
            ->joinWith('arrivals');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [10, 10]
            ],
            'sort' => [
                'defaultOrder' => [
                    "late_arrival_count" => SORT_DESC
                ],
                'attributes' => [
                    'id',
                    'first_name' => [
                        'asc' => ['first_name' => SORT_ASC],
                        'desc' => ['first_name' => SORT_DESC]
                    ],
                    'last_name' => [
                        'asc' => ['last_name' => SORT_ASC],
                        'desc' => ['last_name' => SORT_DESC]
                    ],
                    'late_arrival_count' => [
                        'asc' => ["SUM(arrival.is_late)" => SORT_ASC],
                        'desc' => ["SUM(arrival.is_late)" => SORT_DESC]
                    ]
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->groupBy(['employee.id', 'employee.first_name', 'employee.last_name']);

        $query->andFilterWhere(['like', 'first_name', $this->first_name]);
        $query->andFilterWhere(['like', 'last_name', $this->last_name]);

        return $dataProvider;
    }
}