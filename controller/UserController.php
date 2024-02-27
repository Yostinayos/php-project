<?php

require_once 'model\User.php';


class UserController extends Controller{
    




    public static function router()
    {
        switch (self::$method) {
            case 'GET':
           
                if (!isset(self::$request[1])) {
                    self::index();
                    return;     
                }

                switch (self::$request[1]) {
                    case 'deleded_users':

                        self::deleded();
                        break;
                        case 'user_prop':
                            $id = self::$request[2];
                            self::user_prop($id);
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
     * get all users
     */

    public static function index()
    {
        $users=User::all();
        

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $users,
        ];

        $json_data = json_encode($response);

        echo $json_data;
    }


    /**
     * Get single user by id
     */
    public static function show($id)
    {
        $user=User::show($id);
        
        if (!$user) {
            $customer = 'No user with this id';
        }

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $user,
        ];

        $json_data = json_encode($response);

        echo $json_data;
    }

    /**
     * Get all deleded user
     */
    public static function deleded()
    {
        $users=User::deleted();
      

        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $users,
        ];

        $json_data = json_encode($response);

        echo $json_data;
        
    }

    /**
     *restore deleded user
     */
    public static function restore($id)
    {
        $user=User::restore($id);
        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $user,
        ];

        $json_data = json_encode($response);

        echo $json_data;
       
    }


    /**
     * Save new user to Database
     */
    public static function store($data)
    {
       $user= User::store($data);
       $response = [
        'status' => 200,
        'message' => ' ok',
        'data' => $user,
    ];

    $json_data = json_encode($response);

    echo $json_data;
       
    }
    public static function update($id,$data)
    {
       $user= User::update($id,$data);
       $response = [
        'status' => 200,
        'message' => ' ok',
        'data' => $user,
    ];

    $json_data = json_encode($response);

    echo $json_data;
       
    }

    /**
     * soft delete  user from Database
     */
    public static function delete($id)
    {
        $user=User::delete($id);
        
        $response = [
            'status' => 200,
            'message' => ' ok',
            'data' => $user,
        ];

        $json_data = json_encode($response);

        echo $json_data;
        
        
    }
    public static function user_prop($id){
        $user=User::user_prop($id);
        $response = [
           'status' => 200,
           'message' =>'ok',
            'data' => $user,
        ];
        
        $json_data = json_encode($response);

        echo $json_data;
    }
}

