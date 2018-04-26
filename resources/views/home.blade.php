<!DOCTYPE html>
<html>
  <title>My shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Arapey" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src='js/shop_code.js'></script>
  <style>
    body{
      font-family: 'Arapey', serif;
      letter-spacing:2px;
      font-size:17px;
    }
    h2,h1{
      font-family: 'Arapey', serif;
      font-size:35px;
    }
  </style>
<body id='top'>

  @if (session('alert'))
      <div class="alert alert-success">
        <script>
          alert('deleted successfuly!');
        </script>
      </div>
  @endif

  @if ($product)
  <script type="text/javascript">
    $(window).on('load',function(){
      document.getElementById('search_product').style.display='block';
      document.getElementById('search_product_name').innerHTML= '{{$product->productName}}';
      document.getElementById('search_product_price').innerHTML= '$'+ '{{$product->productCost}}';
      document.getElementById('search_product_category').innerHTML= '@foreach ($categories as $category)'+
      '@foreach ($category->products as $curr_prod)'+
      '@if ($curr_prod->id == $product->id)'+
      '{{$category->categoryName}}'+
      '@endif'+
      '@endforeach'+
      '@endforeach';
    });
  </script>
  @endif

  <nav class="w3-sidebar w3-bar-block w3-collapse w3-animate-left w3-card" style="z-index:3;width:250px;font-family: 'Arapey', serif;letter-spacing:3px;font-size:18px" id="mySidebar">
    <a class="w3-bar-item w3-button w3-border-bottom w3-large" href="#" style='background-image: url("pic.jpg"); '>
        <p class="w3-xlarge" style="padding:32px 15px;font-weight:bold;"><span style="font-family: 'Dancing Script', cursive;">M</span>y <span style="font-family: 'Dancing Script', cursive;">S</span>hop</p>
    </a>
    <a class="w3-bar-item w3-button w3-hide-large w3-large" href="javascript:void(0)" onclick="w3_close()">Close <i class="fa fa-remove"></i></a>
    <a class="w3-bar-item w3-button w3-black" href="#top">Home</a>
    <a class="w3-bar-item w3-button" href="#categories">Categories</a>
    <a class="w3-bar-item w3-button" href="#products">Products</a>
    <a class="w3-bar-item w3-button" href="#customers">Customers</a>
    <a class="w3-bar-item w3-button" href="#orders">Orders</a>
    <a class="w3-bar-item w3-button" onclick='showStats()'>Statistics</a>
  </nav>

  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

  <div class="w3-main" style="margin-left:250px;">

  <div id="myTop" class="w3-container w3-top w3-large w3-black w3-row">
    <div class='w3-col' style='width:50%'>
      <p><i class="fa fa-bars w3-button w3-black w3-hide-large w3-xlarge" onclick="w3_open()"></i>
      <span id="myIntro" class="w3-hide">My shop</span></p>
    </div>
    <div class='w3-col' style='width:50%'>
      <form class="w3-container w3-card-4" action = "/" method = "post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input id='searchField' name='productName' class="w3-input w3-border-0 w3-round-large w3-hide w3-black" type="text" style="width:55%;margin-top:5px;" placeholder="Product name" required>
        <button type='submit' id='search' class="w3-hide w3-btn w3-black"><i class="fa fa-search"></i></button>
      </form>
    </div>
  </div>

  <header class="w3-container w3-black w3-card-4" style="padding:64px 32px;background-image: url('pic2.jpg'); background-position:center; background-size:cover;">
    <h1 class="w3-xxxlarge" style="font-family: 'Arapey', serif; color:black"><span style="font-family: 'Dancing Script', cursive;font-size:70px">W</span>elcome to my s<span style='color:white'>h</span>op</h1>
  </header>

    <!-- Categories Container -->
    <div id='categories' class='w3-container w3-card-4' style='padding: 50px;'>
      <h2>Categories</h2>
      <hr style='width:16%;'/>
      <p>Manage categories of products</p>
      <table border = 1 class="w3-table w3-striped w3-bordered w3-table-all" style='color:black;'>
        <col width="50" align="left">
        <col width="350" align="left">
        <col width="30" align="left">
        <col width="30" align="center">
        <col width="30" align="center">
            <tr>
               <td class='w3-black'>ID</td>
               <td class='w3-black'>Category</td>
               <td class='w3-black'>Products</td>
               <td class='w3-black'></td>
               <td class='w3-black'></td>
            </tr>
             @foreach ($categories as $category)
               <tr>
                 <td>{{ $category->id }}</td>
                 <td>{{ $category->categoryName }}</td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block' onclick="showProductList({{$category->products}})">View</button></td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block' onclick="editCategory('{{$category->id}}')">Edit</button></td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block'><a href = '/category/{{ $category->id }}'>Delete</a></button></td>
               </tr>
             @endforeach
        </table>
        <br /><br />
      <!-- Add new category -->
      <div class="w3-half w3-margin-top">
        <form class="w3-container w3-card-4" action = "/category" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <p>
            Add new category
            <br /><br />
            <input name='categoryName' class="w3-input w3-animate-input" type="text" style="width:90%" placeholder="Category name" required>
          </p>
          <p>
            <button type='submit' class="w3-btn w3-card-4 w3-section w3-black w3-ripple"> ADD </button>
          </p>
        </form>
      </div>
    </div>

    <!-- Products Container -->
    <div id='products' class='w3-container w3-card-4' style='padding: 50px;'>
      <h2>Products</h2>
      <hr style='width:13%;'/>
      <p>Manage the products of the shop</p>
      <table border = 1 class="w3-table w3-striped w3-bordered w3-table-all" style='color:black;'>
        <col width="50" align="left">
        <col width="200" align="left">
        <col width="100" align="left">
        <col width="100" align="left">
        <col width="30" align="center">
        <col width="30" align="center">
        <col width="30" align="center">
        <col width="30" align="center">
            <tr>
               <td class='w3-black'>ID</td>
               <td class='w3-black'>Name</td>
               <td class='w3-black'>Price</td>
               <td class='w3-black'>Category</td>
               <td class='w3-black'></td>
               <td class='w3-black'></td>
               <td class='w3-black'></td>
               <td class='w3-black'>Comment</td>
            </tr>
             @foreach ($categories as $category)
              @foreach ($category->products as $product)
               <tr>
                 <td>{{ $product->id }}</td>
                 <td>{{ $product->productName }}</td>
                 <td>${{ $product->productCost }}</td>
                 <td>{{ $category->categoryName }}</td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block' onclick="showProduct('{{ $product->productName }}','{{ $product->productCost }}', '{{ $category->categoryName }}', '{{ $product->comments }}')">Details</button></td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block' onclick="editProduct('{{ $product->id }}', '{{ $product->productName }}', '{{ $product->productCost }}', '{{ $category->id }}')">Edit</button></td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block'><a href = '/product/{{ $product->id }}'>Delete</a></button></td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block' onclick="commentProduct('{{$product->id}}', '{{ $product->productName }}', '{{ $product->productCost }}', '{{ $category->categoryName }}')">Add</button></td>
               </tr>
               @endforeach
             @endforeach
        </table>
      <br /><br />
      <!-- Add new product -->
      <div class="w3-half w3-margin-top">
        <form class="w3-container w3-card-4" action = "/product" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <p>
            Add new product
            <br /><br />
            <input name='productName' class="w3-input w3-animate-input" type="text" style="width:90%" placeholder="Product name" required>
            <br />
            <input name='productCost' class="w3-input w3-animate-input" type="text" style="width:90%" placeholder="Product cost" required>
            <br />
            <select class="w3-select" name="categoryId">
              <option value="" disabled selected>Choose a category</option>
              @foreach ($categories as $category)
              <option value="{{$category->id}}">{{ $category->categoryName }}</option>
              @endforeach
            </select>
          </p>
          <p>
            <button type='submit' class="w3-btn w3-card-4 w3-section w3-black w3-ripple"> ADD </button>
          </p>
        </form>
      </div>
  </div>

  <!-- Customers Container -->
  <div id='customers' class='w3-container w3-card-4' style='padding: 50px;'>
    <h2>Customers</h2>
    <hr style='width:16%;'/>
    <p>Manage customers of the shop</p>
    <table border = 1 class="w3-table w3-striped w3-bordered w3-table-all" style='color:black;'>
      <col width="50" align="left">
      <col width="250" align="left">
      <col width="30" align="left">
      <col width="30" align="left">
          <tr>
             <td class='w3-black'>ID</td>
             <td class='w3-black'>Name</td>
             <td class='w3-black'></td>
             <td class='w3-black'></td>
          </tr>
           @foreach ($customers as $customer)
             <tr>
               <td>{{ $customer->id }}</td>
               <td>{{ $customer->customerName }}</td>
               <td><button class='w3-btn w3-border w3-card-4 w3-block' onclick="editCustomer('{{ $customer->id }}', '{{ $customer->customerName }}')">Edit</button></td>
               <td><button class='w3-btn w3-border w3-card-4 w3-block'><a href='/customer/{{ $customer->id }}'>Delete</a></button></td>
             </tr>
           @endforeach
      </table>
    <br /><br />
    <!-- Add new customer -->
    <div class="w3-half w3-margin-top">
      <form class="w3-container w3-card-4" action = "/customer" method = "post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <p>
          Add new customer
          <br /><br />
          <input name='customerName' class="w3-input w3-animate-input" type="text" style="width:90%" placeholder="Customer name" required>
        </p>
        <p>
          <button type='submit' class="w3-btn w3-card-4 w3-section w3-black w3-ripple"> ADD </button>
        </p>
      </form>
    </div>
  </div>


  <!-- Orders Container -->
  <div id='orders' class='w3-container w3-card-4' style='padding: 50px;'>
    <h2>Orders</h2>
    <hr style='width:10%;'/>
    <p>Manage orders of the shop</p>
    <table border = 1 class="w3-table w3-striped w3-bordered w3-table-all" style='color:black;'>
      <col width="50" align="left">
      <col width="150" align="left">
      <col width="150" align="left">
      <col width="30" align="left">
      <col width="30" align="left">
          <tr>
             <td class='w3-black'>ID</td>
             <td class='w3-black'>Customer</td>
             <td class='w3-black'>Product</td>
             <td class='w3-black'></td>
             <td class='w3-black'></td>
          </tr>
           @foreach ($customers as $customer)
            @foreach ($customer->orders as $order)
             <tr>
               <td>{{ $order->id }}</td>
               <td>{{ $customer->customerName }}</td>
               @foreach ($products as $product)
                @if ($product->id == $order->product_id )
                 <td>{{ $product->productName }}</td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block' onclick="editOrder('{{ $order->id }}', '{{ $customer->id }}', '{{ $product->id }}')">Edit</button></td>
                 <td><button class='w3-btn w3-border w3-card-4 w3-block'><a href='/order/{{ $order->id }}'>Delete</a></button></td>
                @endif
               @endforeach
             </tr>
             @endforeach
           @endforeach
      </table>
    <br /><br />
    <!-- Add new order -->
    <div class="w3-half w3-margin-top">
      <form class="w3-container w3-card-4" action = "/order" method = "post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <p>
          Add new order
          <br /><br />
          <select class="w3-select" name="customer_id">
            <option value="" disabled selected>Choose a customer</option>
            @foreach ($customers as $customer)
            <option value="{{$customer->id}}">{{ $customer->customerName }}</option>
            @endforeach
          </select>
          <br /><br />
          <select class="w3-select" name="product_id">
            <option value="" disabled selected>Choose a product</option>
            @foreach ($products as $product)
            <option value="{{$product->id}}">{{ $product->productName }}</option>
            @endforeach
          </select>
        </p>
        <p>
          <button type='submit' class="w3-btn w3-card-4 w3-section w3-black w3-ripple"> Buy </button>
        </p>
      </form>
    </div>
  </div>


  <!-- product Modal -->
  <div id="product" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black w3-display-container">
        <span onclick="$('#product').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Product Info</h1>
      </div>
      <div class="w3-container">
        <h5>Product name: <b id='product_name'></b></h5>
        <h5>Product price: <b id='product_price'></b></h5>
        <h5>Product category: <b id='product_category'></b></h5>
      </div>
      <div class="w3-container w3-black">
        <h1>Comments</h1>
      </div>
      <div class="w3-container">
        <h5 id='product_comments'></h5>
      </div>
    </div>
  </div>

  <!-- search product Modal -->
  <div id="search_product" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black w3-display-container">
        <span onclick="$('#search_product').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Product Info</h1>
      </div>
      <div class="w3-container">
        <h5>Product name: <b id='search_product_name'></b></h5>
        <h5>Product price: <b id='search_product_price'></b></h5>
        <h5>Product category: <b id='search_product_category'></b></h5>
      </div>
    </div>
  </div>

  <!-- Category products Modal -->
  <div id="category_products" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black w3-display-container">
        <span onclick="$('#category_products').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Products list</h1>
      </div>
      <div>
        <table id='products_table' border = 1 class="w3-table w3-striped w3-table-all" style='color:black;'>
          <col width="50" align="left">
          <col width="150" align="left">
        </table>
      </div>
    </div>
  </div>

  <!-- Edit category Modal -->
  <div id="edit_category" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black">
        <span onclick="$('#edit_category').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Edit Category</h1>
      </div>
      <div class="w3-container">
        <p>Edit the name of the category: </p>
        <form id='edit_cat_form' action = "" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Category name" required name="categoryName"></p>
          <p><button class="w3-btn w3-card-4 w3-black" type="submit">Edit</button></p>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit product Modal -->
  <div id="edit_product" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black">
        <span onclick="$('#edit_product').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Edit Product</h1>
      </div>
      <div class="w3-container">
        <p>Edit the name of the category: </p>
        <form id='edit_prod_form' action = "" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <p><input id='edit_product_name' class="w3-input w3-padding-16 w3-border" type="text" placeholder="Product name" required name="productName" value=''></p>
          <p><input id='edit_product_cost' class="w3-input w3-padding-16 w3-border" type="text" placeholder="Product price" required name="productCost" value=''></p>
          <select class="w3-select" name="categoryId">
            <option id='cat_id' value="" disabled selected>Choose a category</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{ $category->categoryName }}</option>
            @endforeach
          </select>
          <p><button class="w3-btn w3-card-4 w3-black" type="submit">Edit</button></p>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit customer Modal -->
  <div id="edit_customer" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black">
        <span onclick="$('#edit_customer').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Edit Cusromer</h1>
      </div>
      <div class="w3-container">
        <p>Edit the name of the customer: </p>
        <form id='edit_cust_form' action = "" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <p><input id='edit_customer_name' class="w3-input w3-padding-16 w3-border" type="text" placeholder="Product name" required name="customerName" value=''></p>
          <p><button class="w3-btn w3-card-4 w3-black" type="submit">Edit</button></p>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit order Modal -->
  <div id="edit_order" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black">
        <span onclick="$('#edit_order').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Edit Product</h1>
      </div>
      <div class="w3-container">
        <p>Edit the order: </p>
        <form id='edit_ord_form' action = "" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <select class="w3-select" name="productId">
            <option value="" disabled selected>Choose a product</option>
            @foreach ($products as $product)
            <option value="{{$product->id}}">{{ $product->productName }}</option>
            @endforeach
          </select>
          <br /><br />
          <select class="w3-select" name="customerId">
            <option value="" disabled selected>Choose a customer</option>
            @foreach ($customers as $customer)
            <option value="{{$customer->id}}">{{ $customer->customerName }}</option>
            @endforeach
          </select>
          <p><button class="w3-btn w3-card-4 w3-black" type="submit">Edit</button></p>
        </form>
      </div>
    </div>
  </div>

  <!-- comment product Modal -->
  <div id="commentProduct" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black w3-display-container">
        <span onclick="$('#commentProduct').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Product Info</h1>
      </div>
      <div class="w3-container">
        <h5>Product name: <b id='comment_product_name'></b></h5>
        <h5>Product price: <b id='comment_product_price'></b></h5>
        <h5>Product category: <b id='comment_product_category'></b></h5>
      </div>
      <div class="w3-container w3-black">
        <h1>Add Comment</h1>
      </div>
      <div class="w3-container w3-padding-32">
        <form id = 'comment_product_form' action = "" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <select class="w3-select" name="customerId" style='width: 20%;margin-right:50px;'>
            <option value="" disabled selected>Choose a customer</option>
            @foreach ($customers as $customer)
            <option value="{{$customer->id}}">{{ $customer->customerName }}</option>
            @endforeach
          </select>
          <select class="w3-select" name="productRate" style='width: 20%;'>
            <option value="" disabled selected>Rate product</option>
            <option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
            <option value="4" >4</option>
            <option value="5" >5</option>
          </select>
          <textarea name='productComment' class='w3-input w3-border w3-margin-top' rows="4" placeholder="Add a comment ..."></textarea>
          <p><button class="w3-btn w3-card-4 w3-black" type="submit">Done!</button></p>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit order Modal -->
  <div id="stats" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom">
      <div class="w3-container w3-black">
        <span onclick="$('#stats').slideUp(500) ;" class="w3-button w3-display-topright w3-large">x</span>
        <h1>Shop Statistics</h1>
      </div>
      <div class="w3-container">
        <div>
          <h4>Best-selling product this week: <b id='best_week'>{{$top}}</b><h4>
          <h4>Best-selling product in store: <b id='best_all'>{{$top_all}}</b></h4>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
