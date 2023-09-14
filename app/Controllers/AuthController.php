<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    protected $model;
    protected $session;
    use ResponseTrait;
    protected $format = 'json';
    public function __construct()
    {
         
        $this->session = session();  
        $this->model = new UsersModel();
        helper("form");
        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *'); 
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT,DELETE'); 
    }
    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        helper("request");
        if (! $this->request->is('post')) {
            return view("auth/login");
        }
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost("password");
        $user = $this->model->where('email', $email)->first();
        // dd($user);
        if($user){ 
            if(password_verify($pass,$user['password'])){ 
                $newdata = [
                    'username'  => $user['name'],
                    'email'     => $user['email'],
                    'role'     => $user['role'],
                    'logged_in' => true,
                ];
                
                $this->session->set($newdata);
                if($user['role']==2){
                    return redirect()->to("/admin");
                }
                elseif($user['role']==1){
                    return redirect()->to("/");  
                }
                else{
                    return redirect()->to("/login"); 
                }
                
            }
            else{
                $this->session->setFlashdata('type', 'danger');
                $this->session->setFlashdata('message', 'password invalid');
                return redirect()->to("login");  
            }
        }
        else{
            $this->session->setFlashdata('type', 'danger');
            $this->session->setFlashdata('message', 'User Email Or password invalid');
            return redirect()->to("login");
        }
    }

    public function register(){
        
        $data = [
            'session' => $this->session,
        ];
        helper("request");
        if (! $this->request->is('post')) {
            return view('auth/register',$data);
        }

       
        $uploadedFile = $this->request->getFile('image');
        if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move('assets/images/auth/', $newName);

        } 
        $data = [
            'name'  => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'role'     => '2',
            'password' =>  $this->request->getPost('password'),
            'image' => base_url('assets/images/auth/' . $newName)
        ];
        if($this->model->insert($data)){
            $this->session->setFlashdata('type', 'success');
            $this->session->setFlashdata('message', 'Registration Complete, please login to continue');
            return redirect()->to("login");
        }
        else{
            $this->session->setFlashdata('type', 'danger');
            $this->session->setFlashdata('message', 'Something went wrong. Please try again');
            return redirect()->to("registration");
        }
    }
}
