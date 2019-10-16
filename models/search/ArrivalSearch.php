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
            [['date', 'time', 'employee_id', 'is_late', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Arrival::find();

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