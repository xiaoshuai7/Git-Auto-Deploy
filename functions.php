<?php
/*
     * 根据二维数组某个字段的值查找数组
    */
function filter_by_value ($array, $field, $value){
    if(is_array($array) && count($array)>0)
    {
        foreach(array_keys($array) as $key){
            $temp[$key] = $array[$key][$field];
            if ($temp[$key] == $value){
                $newarray[$key] = $array[$key];
            }
        }
    }
    return $newarray;
}

/**
  * 返回 json数据
 */
function messageJson($code, $msg, $data = null)
{
    $re = ['code' => $code, 'msg' => $msg, 'data' => empty($data) ? null : $data];
    header('content-type:application/json; charset=utf-8');//Content-Type
    echo json_encode($re);
    exit;
}