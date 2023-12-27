$(document).ready(function () {
  $(document).on("click", ".increment-btn", function (e) {
    e.preventDefault();
    //fetch the value
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var value = parseInt(qty, 10);
    //not a number -> assign 0 on value
    value = isNaN(value) ? 0 : value;
    //allow max 10 for each product
    if (value < 10) {
      value++;
      var qty = $(this).closest(".product_data").find(".input-qty").val(value);
    }
  });

  $(document).on("click", ".decrement-btn", function (e) {
    e.preventDefault();
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var value = parseInt(qty, 10);
    //not a number -> assign 0 on value
    value = isNaN(value) ? 0 : value;

    if (value > 1) {
      value--;
      var qty = $(this).closest(".product_data").find(".input-qty").val(value);
    }
  });

  $(document).on("click", ".addToCartBtn", function (e) {
    e.preventDefault();
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var product_id = $(this).val();

    $.ajax({
      method: "POST",
      url: "./functions/handleCart.php",
      data: {
        product_id: product_id,
        product_qty: qty,
        scope: "add",
      },
      success: function (response) {
        if (response == 201) {
          alertify.success("Product added to cart");
        } else if (response == "existing") {
          alertify.success("Product already in cart");
        } else if (response == 401) {
          alertify.success("Login to continue");
        } else if (response == 500) {
          alertify.success("Something went wrong");
        } else if (response == 403) {
          alertify.success("Admins are not allowed to perform this action");
        }
      },
    });
  });
  //not using click because when the page reloaded, the increase decrease will not going to work
  $(document).on("click", ".update_qty", function () {
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var product_id = $(this).val();

    var product_id = $(this).closest(".product_data").find(".product_id").val();
    $.ajax({
      method: "POST",
      url: "./functions/handleCart.php",
      data: {
        product_id: product_id,
        product_qty: qty,
        scope: "update",
      },
      success: function (response) {
        // alert(response);
      },
    });
  });
  $(document).on("click", ".deleteItem", function () {
    var cart_id = $(this).val();
    // alert(cart_id);
    $.ajax({
      method: "POST",
      url: "./functions/handleCart.php",
      data: {
        cart_id: cart_id,
        scope: "delete",
      },
      success: function (response) {
        if (response == 200) {
          alertify.success("Product removed from cart");
          $("#mycart").load(location.href + " #mycart");
        } else {
          alertify.success(response);
        }
      },
    });
  });
});

$(document).on("click", ".addToWishlistBtn", function (e) {
  e.preventDefault();
  var qty = $(this).closest(".product_data").find(".input-qty").val();
  var product_id = $(this).val();

  $.ajax({
    method: "POST",
    url: "./functions/handleWishlist.php",
    data: {
      product_id: product_id,
      product_qty: qty,
      scope: "add",
    },
    success: function (response) {
      if (response == 201) {
        alertify.success("Product added to wishlist");
      } else if (response == "existing") {
        alertify.success("Product already in wishlist");
      } else if (response == 401) {
        alertify.success("Login to continue");
      } else if (response == 500) {
        alertify.success("Something went wrong");
      } else if (response == 403) {
        alertify.success("Admins are not allowed to perform this action");
      }
    },
  });
});

$(document).on("click", ".toggleWishlistBtn", function (e) {
  e.preventDefault();
  var wishlist_id = $(this).val();

  $.ajax({
    method: "POST",
    url: "./functions/handleWishlist.php",
    data: {
      wishlist_id: wishlist_id,
      scope: "delete",
    },
    success: function (response) {
      if (response == 201) {
        alertify.success("Product removed from wishlist");
        $("#wishlistContainer").load(location.href + " #wishlistContainer");
      } else {
        alertify.success("Something went wrong");
      }
    },
  });
});
