<?php

class User extends Model {
const TABLE='users';

public static function user_prop($id){
    $sql="select * from `users` join `posts` on 
    `users`.`id` = `posts`.`user_id` join `comments` on
     `users`.`id` = `comments`.`user_id` where `users`.`id`= $id  ";
     $res= self::fetch_all($sql);
   
   return $res;
}
}

