<?php

require_once 'model\Comment.php';


class CommentController extends Controller{
    




    public static function router()
    {
        switch (self::$method) {
            case 'GET':
           
                if (!isset(self::$request[1])) {
                    self::index();
                    return;     
                }

                switch (self::$request[1]) {
                    case 'deleded_comment':

                        self::deleded();
                        break;

                    

                    default:
                        $id = self::$request[1];

                        self::show($id);
                        break;
                }
                break;


            case 'Comment':
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
     * get all Comments
     */

    public static function index()
    {
        $Comments=Comment::all();
        

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Comments,
        ];

        $json_data = json_encode($response);

        echo $json_data;
    }


    /**
     * Get single Comment by id
     */
    public static function show($id)
    {
        $Comment=Comment::show($id);
        
        if (!$Comment) {
            $Comment = 'No Comment with this id';
        }

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Comment,
        ];

        $json_data = json_encode($response);

        echo $json_data;
    }

    /**
     * Get all deleded Comment
     */
    public static function deleded()
    {
        $Comments=Comment::deleted();
      

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Comments,
        ];

        $json_data = json_encode($response);

        echo $json_data;
        
    }

    /**
     *restore deleded Comment
     */
    public static function restore($id)
    {
        $Comment=Comment::restore($id);
        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Comment,
        ];

        $json_data = json_encode($response);

        echo $json_data;
       
    }


    /**
     * Save new Comment to Database
     */
    public static function store($data)
    {
       $Comment= Comment::store($data);
       $response = [
        'status' => 200,
        'message' => ' ok',
        'data' => $Comment,
    ];

    $json_data = json_encode($response);

    echo $json_data;
       
    }
    public static function update($id,$data)
    {
       $Comment= Comment::update($id,$data);
       $response = [
        'status' => 200,
        'message' => ' ok',
        'data' => $Comment,
    ];

    $json_data = json_encode($response);

    echo $json_data;
       
    }

    /**
     * soft delete  Comment from Database
     */
    public static function delete($id)
    {
        $Comment=Comment::delete($id);
        
        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $Comment,
        ];

        $json_data = json_encode($response);

        echo $json_data;
        
        
    }
}