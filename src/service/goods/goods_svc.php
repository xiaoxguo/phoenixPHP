<?php

class GoodsServiceImpl implements \Erp\IGoodsService
{
    public function create(\Erp\Goods\GoodsDTO $goodsDTO)
    {
        var_dump($goodsDTO);die;
    }
}