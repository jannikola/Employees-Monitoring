<?php

namespace app\models\search;

use app\models\Employee;
use yii\data\ActiveDataProvider;

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
        $query = Employee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [10, 200]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}