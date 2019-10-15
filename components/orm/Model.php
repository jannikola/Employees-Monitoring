<?php

namespace components\orm;


use app\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

class Model extends \yii\base\Model
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public static function createObject($params = [])
    {
        $model = new static();
        $validAttributes = $model->getAllAttributeNames();
        $validParams = array_filter(
            $params,
            function ($key) use ($validAttributes) {
                return in_array($key, $validAttributes);
            },
            ARRAY_FILTER_USE_KEY
        );

        return new static($validParams);
    }

    public function scenarios()
    {
        $allAttributes = $this->getAllAttributeNames();

        return ArrayHelper::merge(parent::scenarios(), [
            static::SCENARIO_CREATE => $allAttributes,
            static::SCENARIO_UPDATE => $allAttributes,
        ]);
    }
    
    public function getAllAttributeNames()
    {
        return ArrayHelper::merge($this->getCurrentObjectProperties(), $this->attributes());
    }

    protected function getCurrentObjectProperties($filter = \ReflectionProperty::IS_PUBLIC)
    {
        $properties = [];
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getProperties($filter) as $property) {
            if ($property->class == $reflection->name) {
                $properties[] = $property->name;
            }
        }

        return $properties;
    }

    public function getPublicName()
    {
        return Inflector::titleize($this->getBaseName());
    }

    public function getBaseName()
    {
        return StringHelper::basename(get_class($this));
    }
}