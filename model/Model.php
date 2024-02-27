<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME','socialMedia');
class Model {
    static $db;
    const TABLE='';
    public function __construct(){
        self::$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    public static function query($sql){
        return self::$db->query($sql);
    }
    public static function fetch_assoc($sql){
        $res= self::query($sql);
        return $res->fetch_assoc();
    }
    public static function fetch_all($sql){
        $res= self::query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    public static function all(){
        $table= static::TABLE;
        $sql= "SELECT * FROM `$table`";
        $res= self::fetch_all($sql);
      return $res;
    }
    public static function show($id){
        $table= static::TABLE;
        $sql= "SELECT * FROM `$table` WHERE id=$id";
        $res= self::fetch_assoc($sql);
      return $res;
    }
    
    static function store($data)
    {
        $key = array_keys($data);
        $k = '`' . implode("`,`", $key) . '`';
        $val = array_values($data);
        $v = "'" . implode("','", $val) . "'";
        $table =static::TABLE;

        $sql = " insert into `$table` ($k) values ($v) ";
        return self::query($sql);
    }
    static function update($id,$data){
        $table =static::TABLE;
       

        $arr=[];
        foreach ($data as $k => $v) {
            $arr[] = "`$k`='$v'";
        }
        $val = implode(',', $arr);
        $sql="update `$table` set $val where `id`= '$id' ";
        return self::query($sql);
    }
    public static function delete($id){
    
        $table= static::TABLE;
        $sql= "update `$table` set `deleded_at`= now() WHERE id=$id";
        $res= self::query($sql);
      return $res;
    }
    public static function deleted(){
        $table= static::TABLE;
        $sql= "SELECT * FROM `$table` where `deleded_at` is not null";
        $res= self::fetch_all($sql);
      return $res;
    }
    public static function restore($id){
    
        $table= static::TABLE;
        $sql= "update `$table` set `deleded_at` =null  WHERE `deleded_at` is not null && id=$id  ";
        $res= self::query($sql);
      return $res;
    }


}
new Model();