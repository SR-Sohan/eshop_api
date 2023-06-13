<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;

class UserController extends BaseController
{
    
    protected $model;
    use ResponseTrait;
    protected $format = 'json';
    public function __construct()
    {
        helper("form");
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        
        $this->model = new UsersModel();
    }

    public function getUser()
    {
        
        $user = $this->model->findAll();

        return $this->respond($user,200);

    }

    public function createUser(){

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[5]',
            "image" => "required",
            "address" => "required"
        ];

        if (!$this->validate($rules)) {
            $response = [
                "message" => $this->validator->getErrors()
            ];
            return $this->failValidationErrors($response);
        }

        $data = [
            "name" => esc($this->request->getVar('name')),
            "email" => esc($this->request->getVar('email')),
            "password" => esc($this->request->getVar('password')),
            "role" => 1,
            "token" =>esc($this->request->getVar('token')),
            "image" => esc($this->request->getVar('image')),
            "address" => esc($this->request->getVar('address'))
        ];



        $user = $this->model->insert($data);
        
        if ($user === false) {
            return $this->fail('Failed to create user', 500);
        }
    
        $response = [
            'message' => 'Data inserted successfully'
        ];
        return $this->respondCreated($response);


    }
}
