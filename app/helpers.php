<?php
if (! function_exists('formatArray')) {
    /**
     * 移除数组中的null，bool转换为整型，以便于客户端JSON处理
     *
     * @param array $array
     * @return array
     */
    function formatArray($array)
    {
        if (!is_array($array)) {
            $array = $array->toArray();
        }
        foreach ($array as $key => $value) {
            if ($value === '' || is_null($value)) {
                $array[$key] = ''; //移除空
            } elseif (is_array($value)) {
                $value = formatArray($value);
                if (!empty($value)) {
                    $array[$key] = $value;
                } else {
                    $array[$key] = '';
                }
            } elseif (is_bool($value)) {
                $array[$key] = intval($value); //bool转换为整型
            }
        }
        return $array;
    }
}
