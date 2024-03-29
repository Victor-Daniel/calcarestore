<?php

namespace store\model;
use store\util\filereader;

class dataproduct
{
    public function poduct_data()
    {
        $info = array(0 => ["product"=> "grey",
            "info"=>"1m<sup>2</sup>"],
            1 => ["product"=> "grey",
            "info"=>"2m<sup>2</sup>"]);

        return $info;
    }
}