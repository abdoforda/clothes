function getFavorites() {
  const favorites = localStorage.getItem('favorites');
  // update count class count_wishlist
  
  if(favorites){
    $(".count_wishlist").text(JSON.parse(favorites).length);
  }
  return favorites ? JSON.parse(favorites) : [];
}



// تحديث المفضلة في localStorage
function updateFavorites(favorites) {
  localStorage.setItem('favorites', JSON.stringify(favorites));
}

// إضافة أو إزالة المنتج من المفضلة
function toggleFavorite(productId) {
  let favorites = getFavorites();

  if (favorites.includes(productId)) {
    // إذا كان المنتج موجودًا، نحذفه
    favorites = favorites.filter(id => id !== productId);
  } else {
    // إذا لم يكن موجودًا، نضيفه
    favorites.push(productId);
  }

  // تحديث المفضلة في localStorage
  updateFavorites(favorites);
}

// تحديث مظهر زر المفضلة بناءً على حالته
function updateButtonAppearance(button, isFavorite) {
  if (isFavorite) {
    button.classList.add('active');
  } else {
    button.classList.remove('active');
  }
}




function getComparisons() {
  $(".result_compare_javascript").empty();
  const comparisons = localStorage.getItem('comparisons');
  if(comparisons){
    // foreach data
    JSON.parse(comparisons).forEach(element => {
      $(".result_compare_javascript").append(`<div class="tf-compare-item">
                                        <div class="position-relative">
                                            
                                            <a href="/product/${element.id}">
                                                <img class="radius-3" src="${element.image}" alt="">
                                            </a>
                                        </div>
                                    </div>`);
    });
  }
  return comparisons ? JSON.parse(comparisons) : [];
}

// تحديث قائمة المقارنات في localStorage
function updateComparisons(comparisons) {
  localStorage.setItem('comparisons', JSON.stringify(comparisons));
}

// إضافة أو إزالة منتج من المقارنات
function toggleComparison(product) {
  let comparisons = getComparisons();

  // التحقق مما إذا كان المنتج موجودًا
  const exists = comparisons.some(item => item.id === product.id);

  if (exists) {
    // إذا كان موجودًا، نحذفه
    comparisons = comparisons.filter(item => item.id !== product.id);
  } else {
    // إذا لم يكن موجودًا، نضيفه
    comparisons.push(product);
  }

  // تحديث قائمة المقارنات
  updateComparisons(comparisons);
}

// تحديث مظهر الزر بناءً على حالته
function updateButtonAppearance(button, isCompared) {
  if (isCompared) {
    button.classList.add('active');
  } else {
    button.classList.remove('active');
  }
}

// تهيئة الأزرار
function resetButtons() {

  document.querySelectorAll('.favorite-btn').forEach(button => {
    // إزالة جميع الأحداث السابقة
    const newButton = button.cloneNode(true);
    button.parentNode.replaceChild(newButton, button);
    
    const productId = newButton.getAttribute('data-product-id');
  
    // تحديث المظهر بناءً على حالة المنتج
    updateButtonAppearance(newButton, getFavorites().includes(productId));
  
    // إضافة حدث الضغط على الزر
    newButton.addEventListener('click', () => {
      toggleFavorite(productId);
      updateButtonAppearance(newButton, getFavorites().includes(productId));
    });
  });
  

  document.querySelectorAll('.compare-btn').forEach(button => {
    // إنشاء نسخة من الزر مع إزالة جميع الأحداث السابقة
    const newButton = button.cloneNode(true);
    button.parentNode.replaceChild(newButton, button);
    
    const productId = newButton.getAttribute('data-product-id');
    const productImage = newButton.getAttribute('data-product-image');
  
    // تحديث المظهر بناءً على حالة المنتج
    const comparisons = getComparisons();
    const isCompared = comparisons.some(item => item.id === productId);
    updateButtonAppearance(newButton, isCompared);
  
    // إضافة حدث الضغط على الزر
    newButton.addEventListener('click', () => {
      toggleComparison({ id: productId, image: productImage });
      const updatedComparisons = getComparisons();
      updateButtonAppearance(newButton, updatedComparisons.some(item => item.id === productId));
    });
  });

  
  
}

function getCart() {
  const cart = localStorage.getItem('cart');
  $(".result_cart_home").empty();
  if(cart){
    $(".count_cart").text(JSON.parse(cart).length);
    // foreach data
    var x = 0;
    var price_short = 0;
    JSON.parse(cart).forEach(element => {
      price_short += element.price * element.count;
      $(".result_cart_home").append(`<div class="tf-mini-cart-item">
                                        <div class="tf-mini-cart-image">
                                            <a href="/product/${element.slug}">
                                                <img src="${element.image}" alt="">
                                            </a>
                                        </div>
                                        <div class="tf-mini-cart-info">
                                            <a class="title link" href="/product/${element.slug}">${element.name}</a>
                                            <div class="meta-variant">${element.color}</div>
                                            <div class="price fw-6">${element.price} EGP</div>
                                            <div class="tf-mini-cart-btns">
                                                <div class="wg-quantity small">
                                                    <span class="btn-quantity minus-btn">-</span>
                                                    <input class="liveCountCart" data-id="${x}" type="text" name="number" value="${element.count}">
                                                    <span class="btn-quantity plus-btn">+</span>
                                                </div>
                                                <div class="tf-mini-cart-remove" data-id="${x}">حذف</div>
                                            </div>
                                        </div>
                                    </div>`);
      x++;
    });
    $(".price_short").text(price_short);
  }
  return cart ? JSON.parse(cart) : [];
}

// تحديث السلة في localStorage
function updateCart(cart) {
  localStorage.setItem('cart', JSON.stringify(cart));
}

// إضافة أو إزالة منتج من السلة
function toggleCartItem(product) {
  let cart = getCart();

  // التحقق إذا كان المنتج موجودًا بالفعل في السلة
  const productIndex = cart.findIndex(item => 
    item.id === product.id && item.name === product.name && item.price === product.price && item.image === product.image && item.color === product.color && item.size === product.size && item.count === product.count && item.slug === product.slug
  );

  if (productIndex > -1) {
    // إذا كان موجودًا، نحذفه
    cart.splice(productIndex, 1);
  } else {
    // إذا لم يكن موجودًا، نضيفه
    cart.push(product);
  }

  // تحديث السلة في localStorage
  updateCart(cart);
}

// إزالة المنتج من السلة
function removeCartItem(indexElement) {
  let cart = getCart();
  cart.splice(indexElement, 1);
  updateCart(cart);
  getCart();
}

// تعديل العدد للمنتج في السلة
function updateCartItem(indexElement, count) {
  let cart = getCart();
  cart[indexElement].count = count;
  updateCart(cart);
  getCart();
}

// إفراغ السلة
function clearCart() {
  let cart = getCart();
  cart = [];
  updateCart(cart);
  getCart();
}



resetButtons();
getFavorites();
getCart();

$(document).ready(function() {
  $(".btn_coupon").click(function() {
    var coupon = $("#coupon").val();
    if(coupon == ""){
      alert("يرجى ادخال كوبون الخصم");
      return;
    }
    $(".discountDiv").fadeOut();  

    $.post('/coupon', {coupon:coupon,_token:$("meta[name='csrf-token']").attr("content")}, function(data) {
      if(data.success){
        var price = parseFloat($(".price_no_shipping").data("price"));
        var shippingCost = parseFloat($(".shippingCost").data("price"));
        if(data.data.discount_price != null){
          price = (price - parseFloat(data.data.discount_price));
          $(".discountDiv").removeClass("d-none");
          $(".discount_price").text(data.data.discount_price + " EGP");
          if(price < 0){
            price = 0;
          }
          $(".final_price").text((price + shippingCost) + " EGP");
        }else{
          if(data.data.discount_percentage != null){
            price = (price - (price * (data.data.discount_percentage / 100)));
            $(".discountDiv").removeClass("d-none");
            $(".discount_price").text(data.data.discount_percentage + "%");
            if(price < 0){
              price = 0;
            }
            $(".final_price").text((price + shippingCost) + " EGP");
          }
        }
        return;
      }

      alert("كود الخصم إنتهي او غير موجود");

    });


  });
});