<?php

namespace App\Models;


class post
{
    private static $info_gunungs =  [
    
    ["judul"=>"Judul Pertama",
    "slug"=>"judul-pertama",
    "penulis"=>"Bagas",
    "body"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis deserunt odio, quos nostrum ut inventore architecto exercitationem accusamus. Minima earum est blanditiis vel et pariatur excepturi impedit nostrum aperiam, consectetur dolorem atque cum distinctio doloremque placeat? Iure explicabo animi ipsa suscipit delectus eaque, ipsam asperiores nemo quaerat, corporis corrupti et saepe! Quisquam magnam, quia soluta explicabo, sunt possimus error blanditiis modi aliquam eveniet qui ad ducimus consequuntur provident expedita sint, ipsa eligendi optio at quam ipsam veritatis rerum dolores assumenda!"
    ],
    ["judul"=>"Judul kedua",
    "slug"=>"judul-kedua",
    "penulis"=>"Rom",
    "body"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis deserunt odio, quos nostrum ut inventore architecto exercitationem accusamus. Minima earum est blanditiis vel et pariatur excepturi impedit nostrum aperiam, consectetur dolorem atque cum distinctio doloremque placeat? Iure explicabo animi ipsa suscipit delectus eaque, ipsam asperiores nemo quaerat, corporis corrupti et saepe! Quisquam magnam, quia soluta explicabo, sunt possimus error blanditiis modi aliquam eveniet qui ad ducimus consequuntur provident expedita sint, ipsa eligendi optio at quam ipsam veritatis rerum dolores assumenda!"
    ]
    ];

    public static function all(){

        return self::$info_gunungs;
    }

    public static function find($slug){

        $post = self::$info_gunungs;
        $new_post = [];
        foreach($post as $p){
            if($p["slug"]=== $slug){
                $new_post = $p;
            }
        }
        return $new_post;
    }
}
