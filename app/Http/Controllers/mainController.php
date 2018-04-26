<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Category;
use App\Product;
use App\Comment;
use App\Customer;
use App\Order;


class mainController extends Controller{

  public function getTopProduct($orders){
    $product_week = [];
    $product_counts = [];
    $distinct_products = [];
    foreach ($orders as $order){
      array_push($product_week, $order->product_id);
      if (!in_array($order->product_id, $distinct_products)){
        array_push($distinct_products, $order->product_id);
      }
    }
    $count = array_count_values($product_week);
    $allCount = Array();
    $max_count = 0;
    $max_product = NULL;
    foreach($distinct_products as $product){
      if ($count[$product] > $max_count){
        $max_count = $count[$product];
      }
    }
    foreach ($distinct_products as $product){
      if ($count[$product] == $max_count){
        $max_product = $product;
        break;
      }
    }
    $best_product = Product::find($max_product);
    return $best_product;
  }

  public function viewContent(){
    $categories=Category::with('products')->get();
    $products=Product::all();
    $customers=Customer::all();
    $orders_week=Order::where('created_at', '>', Carbon::now()->subWeek())->get();
    $orders_all=Order::all();
    $best_product_week=$this->getTopProduct($orders_week);
    $best_product_all=$this->getTopProduct($orders_all);

    $arr=Array('product'=>NULL ,'categories'=>$categories, 'products'=>$products, 'customers'=>$customers, 'top'=>$best_product_week->productName, 'top_all'=>$best_product_all->productName);
    return view('home', $arr);
  }


  public function addCategory(Request $request){
    $category = new Category;
    $category->categoryName = $request->categoryName;
    $category->save();
    return redirect('/');
  }

  public function addProduct(Request $request){
    $product = new Product;
    $product->productName = $request->productName;
    $product->productCost = $request->productCost;
    $product->category_id = $request->categoryId;
    $product->save();
    return redirect('/');
  }

  public function addCustomer(Request $request){
    $customer = new Customer;
    $customer->customerName = $request->customerName;
    $customer->save();
    return redirect('/');
  }

  public function addOrder(Request $request){
    $order = new Order;
    $order->customer_id = $request->customer_id;
    $order->product_id = $request->product_id;
    $order->save();
    return redirect('/');
  }

  public function updateCategory(Request $request, int $id){
    $category = Category::find($id);
    $category->categoryName = $request->categoryName;
    $category->save();
    return redirect('/');
  }

  public function updateProduct(Request $request, int $id){
    $product = Product::find($id);
    $product->productName = $request->productName;
    $product->productCost = $request->productCost;
    $product->category_id = $request->categoryId;
    $product->save();
    return redirect('/');
  }

  public function updateCustomer(Request $request, int $id){
    $customer = Customer::find($id);
    $customer->customerName = $request->customerName;
    $customer->save();
    return redirect('/');
  }

  public function updateOrder(Request $request, int $id){
    $order = Order::find($id);
    $order->customer_id = $request->customerId;
    $order->product_id = $request->productId;
    $order->save();
    return redirect('/');
  }

  public function deleteCategory(int $id){
    $categories = Category::all();
    foreach($categories as $category){
      foreach($category->products as $product){
        if ($product->category_id == $id){
          return redirect('/');
        }
      }
    }
    $category = Category::find($id);
    $category->delete();
    return redirect('/')->with('alert', 'deleted!');;
  }

  public function deleteProduct(int $id){
    $comments = Comment::all();
    foreach($comments as $comment){
      if ($comment->product_id == $id){
        return redirect('/');
      }
    }
    $product = Product::find($id);
    $product->delete();
    return redirect('/')->with('alert', 'deleted!');;
  }

  public function deleteCustomer(int $id){
    $comments = Comment::all();
    foreach($comments as $comment){
      if($comment->customer_id == $id){
        $comment->delete();
      }
    }
    $customer = Customer::find($id);
    $customer->delete();
    return redirect('/')->with('alert', 'deleted!');
  }

  public function deleteOrder(int $id){
    $order = Order::find($id);
    $order->delete();
    return redirect('/')->with('alert', 'deleted!');
  }

  public function searchProduct(Request $request){
    $categories=Category::with('products')->get();
    $products=Product::all();
    $customers=Customer::all();
    $orders_week=Order::where('created_at', '>', Carbon::now()->subWeek())->get();
    $orders_all=Order::all();
    $best_product_week=$this->getTopProduct($orders_week);
    $best_product_all=$this->getTopProduct($orders_all);
    $product_name = $request->productName;
    $product_name = strtolower($product_name);
    $products = Product::all();
    $result='not found';
    foreach ($products as $product){
      if (strtolower($product->productName) == $product_name){
        $result = 'found';
        $arr=Array('product'=>$product ,'categories'=>$categories, 'products'=>$products, 'customers'=>$customers, 'top'=>$best_product_week->productName, 'top_all'=>$best_product_all->productName);
        return view('home', $arr);
      }
    }
    return redirect('/');
  }

  public function commentProduct(Request $request, int $id){
    $comment = new Comment;
    $comment->commentText = $request->productComment;
    $comment->rate = $request->productRate;
    $comment->customer_id = $request->customerId;
    $comment->product_id = $id;
    $comment->save();
    return redirect('/');
  }

}
