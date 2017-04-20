<?php
namespace Foundation;

trait PropInsMehtonds
{
    public function setByArr($arr)
    {
        if (!is_array($arr)) {
            return false;
        }
        foreach ($arr as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    static public function fromArr($arr)
    {
        $callCls = get_called_class();
        $dto     = new $callCls;
        $dto->setByArr($arr);

        return $dto;

    }

    static public function fromJson($json)
    {
        $callCls = get_called_class();
        $dto     = new $callCls;
        $arr     = json_decode($json, true);
        // XDBC::isTrue($arr,"json_decode fail! : $json") ;
        $dto->setByArr($arr);

        return $dto;
    }

    static public function arrIns($arr, $filtKeys = null)
    {
        $callCls = get_called_class();
        $dto     = new $callCls;
        $dto->setByArr($arr, $filtKeys);

        return $dto;

    }

    public function toWhere()
    {
        $arr = get_object_vars($this);
        foreach ($arr as $k=>$v){
            if(is_null($v)){
                unset($arr[$k]);
            }
        }

        return $arr;
    }
}
