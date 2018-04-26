$(document).ready(() => {
  // Add smooth scrolling
  $(".navbar a, nav a, .slideanime").on("click", function (event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();
      // Store hash
      let hash = this.hash;
      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, () => {
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }
  });

  $(window).scroll(() =>  {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})

// Open and close the sidebar on medium and small screens
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

// Change style of top container on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("myTop").classList.add("w3-card-4", "w3-animate-opacity");
        document.getElementById("myIntro").classList.add("w3-show-inline-block");
        document.getElementById("searchField").classList.add("w3-show-inline-block");
        document.getElementById("search").classList.add("w3-show-inline-block");
    } else {
        document.getElementById("myIntro").classList.remove("w3-show-inline-block");
        document.getElementById("myTop").classList.remove("w3-card-4", "w3-animate-opacity");
        document.getElementById("search").classList.remove("w3-show-inline-block");
        document.getElementById("searchField").classList.remove("w3-show-inline-block");
    }
}

function showProduct(productName, productCost, productCategory, productComments){
  document.getElementById('product').style.display='block';
  document.getElementById('product_name').innerHTML= productName;
  document.getElementById('product_price').innerHTML= '$'+ productCost;
  document.getElementById('product_category').innerHTML= productCategory;
  comments = document.getElementById('product_comments');
  allcomms = JSON.parse(productComments);
  comments.innerHTML = ''
  if(allcomms.length === 0)
    comments.innerHTML = "<div class='w3-container w3-card-2 w3-padding-16'><h6>No comments found!</h6></div>"
  for (var i=0; i<allcomms.length; i++){
    comments.innerHTML += "<div class='w3-container w3-card-2 w3-padding-16'>"+
    "<h6><b>Comment: </b>"+allcomms[i]['commentText']+"</h6>"+
    "<h6><b>Rate: </b>"+allcomms[i]['rate']+"</h6>"
  }
}

function showProductList(products){
  document.getElementById('category_products').style.display='block';
  table = document.getElementById('products_table');
  table.innerHTML = '<tr>'+
    "<td class='w3-black'>ID</td>" +
    "<td class='w3-black'>Product</td>"+
  '</tr>';
  for (var i=0; i < products.length; i++){
    table.innerHTML += '<tr><td>'+products[i]['id']+'</td>' +
    '<td>'+products[i]['productName']+'</td></tr>'
  }
}

function editCategory(category_id){
  category_id = parseInt(category_id);
  document.getElementById('edit_cat_form').action = '/category/' + category_id ;
  document.getElementById('edit_category').style.display='block';
}

function editProduct(product_id, product_name, product_cost, product_cat){
  product_id = parseInt(product_id);
  document.getElementById('edit_prod_form').action = '/product/' + product_id ;
  document.getElementById('edit_product_name').value = product_name;
  document.getElementById('edit_product_cost').value = product_cost;
  document.getElementById('cat_id').value = product_cat;
  document.getElementById('edit_product').style.display='block';
}

function editCustomer(customer_id, customer_name){
  customer_id = parseInt(customer_id);
  document.getElementById('edit_cust_form').action = '/customer/' + customer_id ;
  document.getElementById('edit_customer_name').value = customer_name;
  document.getElementById('edit_customer').style.display='block';
}

function editOrder(order_id, customer_id, product_id){
  order_id = parseInt(order_id);
  document.getElementById('edit_ord_form').action = '/order/' + order_id ;
  document.getElementById('edit_order').style.display='block';
}

function commentProduct(product_id, product_name, product_price, product_cat){
  document.getElementById('commentProduct').style.display='block';
  document.getElementById('comment_product_form').action = '/product/'+product_id+'/comment';
  document.getElementById('comment_product_name').innerHTML = product_name;
  document.getElementById('comment_product_price').innerHTML = product_price;
  document.getElementById('comment_product_category').innerHTML = product_cat;
  document.getElementById('comment_product_id').value = product_id;
}

function showStats(){
  document.getElementById('stats').style.display='block';
}
