<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use CodeIgniter\API\ResponseTrait;
class SubCategoryController extends BaseController
{
    protected $model;
    use ResponseTrait;
    protected $format = 'json';
    public function __construct()
    {        
        $this->model = new SubCategoryModel();
        helper("form");
        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *'); 
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT,DELETE'); 
    }

    
    public function getSubCategory()
    {
        
        $data = $this->model->findAll();

        return $this->respond($data);
    }

    public function getSubCategoryById($id){
        $data = $this->model->find($id);
        return $this->respond($data);
    }

    public function postSubCategory(){

        // $img = $this->request->getFile('image');
        $uploadedFile = $this->request->getFile('image');
        if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move('assets/images/subcategories/', $newName);

        } 
        $data = [
            'cat_id' => $this->request->getVar('cat_id'),
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'image' => base_url('assets/images/subcategories/' . $newName)
        ];

        

        $this->model->insert($data);

        return $this->respondCreated(['message' => 'Category created successfully']);
    }

     public function dGetSubCategories(){
        $all = [
            'total'=>$this->model->countAll(),
            'categories' => $this->model->paginate(10),
            'pager' => $this->model->pager,
        ];
        return view("subcategories",$all);
    }

    public function dPostSubCategories(){
        if (! $this->request->is('post')) {

            $cat = new CategoryModel();

            $data = $cat->findAll();
            
            return view("addsubcategories",["data" => $data]);
        }


        $uploadedFile = $this->request->getFile('image');
        if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move('assets/images/subcategories/', $newName);

        } 
        $data = [
            'cat_id' => $this->request->getVar('cat_id'),
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'image' => base_url('assets/images/subcategories/' . $newName)
        ];        

        if($this->model->insert($data)){
          return  redirect()->to(base_url('subcategories'));
        }
        
    }


    public function deleteSubCategory($id)
    {
        $item = $this->model->find($id);
        if ($item) {
            $this->model->delete($id);
            return redirect()->to(base_url("/subcategories"));
        } else {
            return $this->failNotFound('Item not found');
        }
    }
}
