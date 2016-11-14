<?php

namespace App\Api\V1\Transformers;

use Illuminate\Database\Eloquent\Model;

use League\Fractal\TransformerAbstract;

abstract class BaseTransformer extends TransformerAbstract
{
    public function transform($model)
    {
        $data = $this->transformData($model);

        foreach ($data as $key => $value) {
            if ($value === '' || is_null($value)) {
                $data[$key] = ''; //移除空
            } elseif (is_array($value)) {
                $value = formatArray($value);
                if (!empty($value)) {
                    $data[$key] = $value;
                } else {
                    $data[$key] = '';
                }
            } elseif (is_bool($value)) {
                $data[$key] = intval($value); //bool转换为整型
            }
        }
        return $data;
    }

    abstract public function transformData($model);
}
