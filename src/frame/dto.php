<?php
namespace Foundation;

class DTO
{
    use PropInsMehtonds;

    public function toJson()
    {
        $arr = get_object_vars($this);

        return json_encode($arr);
    }

    public function toArr()
    {
        $arr = get_object_vars($this);

        return $arr;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function toRequestArr()
    {
        $arr = $this->toArr();
        foreach($arr as $k => $v){
            if(is_null($v)){
                unset($arr[$k]);
            }
        }

        return $arr;
    }
}
