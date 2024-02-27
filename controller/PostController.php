

<?php

require_once 'model\Post.php';


class PostController extends Controller{
    




    public static function router()
    {
        switch (self::$method) {
            case 'GET':
           
                if (!isset(self::$request[1])) {
                    self::index();
                    return;     
                }

                switch (self::$request[1]) {
                    case 'deleded_post':

                        self::deleded();
                        break;

                    

                    default:
                        $id = self::$request[1];

                        self::show($id);
                        break;
                }
                break;


            case 'POST':
                if (!isset(self::$request[1])) {
                    $data=$_POST;
                    self::store($data);
                    return; }
                    switch (self::$request[1]) {
                    case 'update':
                        $data=$_POST;
                        $id = self::$request[2];
                        self::update($id,$data);
                        break;
                  }
                
                break;


            case 'PUT':
                
                switch (self::$request[1]) {
                case 'restore':
                    $id = self::$request[2];
                    self::restore($id);
                    
                
                
                    

                break;


            case 'DELETE':
                if (isset(self::$request[1])) {
                    $id = self::$request[1];

                    self::delete($id);
                }
                break;

            default:

                $response = [
                    'status' => 404,
                    'message' => 'Could not found the requested route!'
                ];

                echo json_encode($response);
        }
        }
    }

    /**
     * get all posts
     */

    public static function index()
    {
        $Posts=Post::all();
        

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Posts,
        ];

        $json_data = json_encode($response);

        echo $json_data;
    }


    /**
     * Get single Post by id
     */
    public static function show($id)
    {
        $Post=Post::show($id);
        
        if (!$Post) {
            $Post = 'No Post with this id';
        }

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Post,
        ];

        $json_data = json_encode($response);

        echo $json_data;
    }

    /**
     * Get all deleded Post
     */
    public static function deleded()
    {
        $Posts=Post::deleted();
      

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Posts,
        ];

        $json_data = json_encode($response);

        echo $json_data;
        
    }

    /**
     *restore deleded Post
     */
    public static function restore($id)
    {
        $Post=Post::restore($id);
        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Post,
        ];

        $json_data = json_encode($response);

        echo $json_data;
       
    }


    /**
     * Save new Post to Database
     */
    public static function store($data)
    {
       $Post= Post::store($data);
       $response = [
        'status' => 200,
        'message' => ' ok',
        'data' => $Post,
    ];

    $json_data = json_encode($response);

    echo $json_data;
       
    }
    public static function update($id,$data)
    {
       $Post= Post::update($id,$data);
       $response = [
        'status' => 200,
        'message' => ' ok',
        'data' => $Post,
    ];

    $json_data = json_encode($response);

    echo $json_data;
       
    }

    /**
     * soft delete  Post from Database
     */
    public static function delete($id)
    {
        $Post=Post::delete($id);
        
        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Post,
        ];

        $json_data = json_encode($response);

        echo $json_data;
        
        
    }
}

