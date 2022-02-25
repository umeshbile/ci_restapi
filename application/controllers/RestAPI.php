<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/API_Controller.php';
class RestAPI extends API_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function login(){
        header("Access-Control-Allow-Origin: *");

        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
            //'requireAuthorization' => true
        ]);

        $payload = [
            'id' => "Your User ID's",
            'other' => "Some other data"
        ];

        // Load Authorization Library or Load in autoload config file
        $this->load->library('authorization_token');

        // genarte a toekn
        $token = $this->authorization_token->generateToken($payload);

        // return data
        $this->api_return([
            'status' => true,
            "result" => [
                'token' => $token
            ]
        ],200);
        
    }

    public function view(){
        header("Access-Control-Allow-Origin: *");

        // API Configration [Retrun Array: User Token Data]
        $user_data = $this->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => true
        ]);

        $this->load->model('Users_Model');
        $users = $this->Users_Model->getusers();
        
        if($users === false){
            $this->api_return([
                'status' => false,
                'message' => 'No records found',
                'result' => []
            ],200); 
        }else{
           // Return data
            $this->api_return([
                'status' => true,
                'result' => [
                    'user_data' => $this->security->xss_clean($users)
                ]
            ],200);
        }
    }

    
}