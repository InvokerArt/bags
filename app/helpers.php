<?php

if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}

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

if (! function_exists('img_fullurl')) {
    function img_fullurl($array)
    {
        if ($array) {
            if (is_array($array)) {
                foreach ($array as $key => $value) {
                    if ($value) {
                        $url[$key] = asset($value);
                    } else {
                        $url[$key] = '';
                    }
                }
            } else {
                $url = asset($array);
            }
            return $url;
        }
    }
}

if (! function_exists('relative_url')) {
    function relative_url($url)
    {
        if (is_array($url)) {
            foreach ($url as $value) {
                if (strstr($value, '://')) {
                    $newUrl[] = str_replace(env('APP_URL'), '', $value);
                } else {
                    $newUrl[] = $value;
                }
            }
        } else {
            if (strstr($value, '://')) {
                $newUrl = str_replace(env('APP_URL'), '', $url);
            } else {
                $newUrl = $url;
            }
        }
        return $newUrl;
    }
}
