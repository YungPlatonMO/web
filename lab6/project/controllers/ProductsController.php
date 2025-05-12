<?php
namespace Project\Controllers;

use core\Controller;
use \Project\Models\Products;

class ProductsController extends Controller
{
    
     public function one($params)
    {
	$products = (new Products) -> getById($params['id']);
			
	$this->title = $products['name'];
	return $this->render('products/one', [
		'text' => $products['description'],
		'h1' => $this->title
	]);
     }
		
     public function Pall()
     {
	
	$this->title = 'Все продукты';
	$products = (new Products) -> getAll();
	return $this->render('products/all', ['products' => $products
	]);
     }
}