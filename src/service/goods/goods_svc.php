<?php

class GoodsServiceImpl extends GoodsSvc implements \Erp\IGoodsService
{
    public function create(\Erp\GoodsDTO $goodsDTO)
    {
        var_dump($goodsDTO);die;
    }
}