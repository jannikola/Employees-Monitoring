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
        $query = Arrival::find()
            ->select(['employee_id', 'is_late' => new Expression("COUNT(is_late)")])
            ->innerJoinWith('employee');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [10, 10]
            ],
            'sort' => [
                'defaultOrder' => [
                    "is_late" => SORT_DESC
                ],
                'attributes' => [
                    'id',
                    'employee.first_name' => [
                        'asc' => ['employee.first_name' => SORT_ASC],
                        'desc' => ['employee.first_name' => SORT_DESC]
                    ],
                    'employee.last_name' => [
                        'asc' => ['employee.last_name' => SORT_ASC],
                        'desc' => ['employee.last_name' => SORT_DESC]
                    ],
                    'is_late' => [
                        'asc' => ["COUNT(is_late)" => SORT_ASC],
                        'desc' => ["COUNT(is_late)" => SORT_DESC]
                    ]
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->groupBy(['employee_id']);

        return $dataProvider;
    }
}