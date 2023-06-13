<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;

class CategoryController extends BaseController
{
  
    protected $model;
    use ResponseTrait;
    protected $format = 'json';
    public function __construct()
    {
        $this->model = new CategoryModel();
        helper("form");
        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *'); 
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT,DELETE'); 
    }
    public function getCategory()
    {
      
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    public function getCategoryById($id){

        $data = $this->model->find($id);
        return $this->respond($data);

    }

    public function dGetCategories(){
        $all = [
            'total'=>$this->model->countAll(),
            'categories' => $this->model->paginate(10),
            'pager' => $this->model->pager,
        ];
        return view("categories",$all);
    }

    public function dPostCategories(){
        if (! $this->request->is('post')) {
            return view("addcategories");
        }


        $uploadedFile = $this->request->getFile('image');
        if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move('assets/images/categories/', $newName);

        } 
        $data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'image' => base_url('assets/images/categories/' . $newName)
        ];        

        if($this->model->insert($data)){
          return  redirect()->to(base_url('categories'));
        }
        
    }

    public function postCategory(){

        // $img = $this->request->getFile('image');
        $uploadedFile = $this->request->getFile('image');
        if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move('assets/images/categories/', $newName);

        } 
        $data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'image' => base_url('assets/images/categories/' . $newName)
        ];

        

        $this->model->insert($data);

        return $this->respondCreated(['message' => 'Category created successfully']);
    }


    public function deleteCategory($id)
    {
        $item = $this->model->find($id);
        if ($item) {
            $this->model->delete($id);
            return redirect()->to(base_url("/categories"));
        } else {
            return $this->failNotFound('Item not found');
        }
    }
}
