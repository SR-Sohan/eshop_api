<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductsModel;
use App\Models\SubCategoryModel;
use CodeIgniter\API\ResponseTrait;

class ProductController extends BaseController
{
    protected $model;
    use ResponseTrait;
    protected $format = 'json';
    public function __construct()
    {
        $this->model = new ProductsModel();
        helper("form");
        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *'); 
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT,DELETE'); 
    }

    public function getProducts(){
        $data = $this->model->findAll();
        return $this->respond($data);
    }
    public function getProductsById($id){
        $data = $this->model->find($id);
        return $this->respond($data);
    }
    public function index()
    {
        $all = [
            'total'=>$this->model->countAll(),
            'categories' => $this->model->paginate(10),
            'pager' => $this->model->pager,
        ];
        return view("products",$all);
    }
    public function create(){
        if (! $this->request->is('post')) {
            $cat = new CategoryModel();
            $subcat = new SubCategoryModel();

            $cat = $cat->findAll();
            $subcat = $subcat->findAll();
            return view("addProducts",["cat" => $cat,"subcat"=> $subcat]);
        }

        $uploadedFile = $this->request->getFile('image');
        if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move('assets/images/products/', $newName);

        } 
        $data = [
            'cat_id' => $this->request->getVar('cat_id'),
            'subcat_id' => $this->request->getVar('subcat_id'),
            'title' => $this->request->getVar('title'),
            'price' => $this->request->getVar('price'),
            'quantity' => $this->request->getVar('quantity'),
            'description' => $this->request->getVar('description'),
            'image' => base_url('assets/images/products/' . $newName)
        ]; 

        if($this->model->insert($data)){
            return  redirect()->to(base_url('products'));
          }
    }
}
