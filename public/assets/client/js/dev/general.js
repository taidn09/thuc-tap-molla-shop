$(document).on("click", ".toggle-password", function () {
  if ($(this).next("input").attr("type") == "password") {
    $(this).next("input").attr("type", "text");
    $(this).removeClass("bi-eye-slash-fill");
    $(this).addClass("bi-eye-fill");
  } else {
    $(this).next("input").attr("type", "password");
    $(this).addClass("bi-eye-slash-fill");
    $(this).removeClass("bi-eye-fill");
  }
});
$(".nav-link[role=tab]").on("click", function () {
  $(".err-msg").html("");
  $("input").val("");
});
$(".close[data-dismiss=modal]").on("click", function () {
  $(".err-msg").html("");
});
// các hàm validate form
function checkIsEmpty(value) {
  return value.trim() == "";
}

function checkName(value, min = 0, max = 0) {
  value = value.trim();
  return (
    value.length >= min && value.length <= max && /^([^0-9]*)$/.test(value)
  );
}

function checkEmail(email) {
  return /\S+@\S+\.\S+/.test(email.trim());
}

function checkPhone(phone) {
  return /^[0]([0-9]){9,10}$/.test(phone);
}
if ($.fn.elevateZoom) {
  $("#product-zoom").elevateZoom({
    gallery: "product-zoom-gallery",
    galleryActiveClass: "active",
    zoomType: "inner",
    cursor: "crosshair",
    zoomWindowFadeIn: 400,
    zoomWindowFadeOut: 400,
    responsive: true,
  });

  // On click change thumbs active item
  $(".product-gallery-item").on("click", function (e) {
    $("#product-zoom-gallery").find("a").removeClass("active");
    $(this).addClass("active");

    e.preventDefault();
  });

  var ez = $("#product-zoom").data("elevateZoom");

  // Open popup - product images
  $("#btn-product-gallery").on("click", function (e) {
    if ($.fn.magnificPopup) {
      $.magnificPopup.open(
        {
          items: ez.getGalleryList(),
          type: "image",
          gallery: {
            enabled: true,
          },
          fixedContentPos: false,
          removalDelay: 600,
          closeBtnInside: false,
        },
        0
      );

      e.preventDefault();
    }
  });
}
$("input").on("input", function () {
  $(this).siblings(".err-msg").html("");
});
$("input[type=password]").on("input", function () {
  $(this).parent().siblings(".err-msg").html("");
});
// validate input number có kết hợp với thư viện input spinner
$("input[type='number']").on("change", function () {
  if (isNaN($(this).val()) || $(this).val() < 0 || $(this).val().trim() == "") {
    $(this).val(1);
  }
});
$("textarea").on("input", function () {
  $(this).siblings(".err-msg").html("");
});
const successPopup = {
  position: "center",
  icon: "success",
  title: "Thành công!",
  showConfirmButton: false,
  timer: 1500,
};
const confirmPopup = {
  title: "Bạn chắc chắn muốn xóa sản phẩm này?",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Vâng, đồng ý!",
  cancelButtonText: "Đóng!",
};
const priceFormatOption = {
  useGrouping: true,
  maximumFractionDigits: 0,
};
function checkUserValid(status){
  if(status === 2){
    window.location.reload()
  }
}
// thêm sản phẩm vào giỏ hàng
function addToCart(id, quantity, size, color) {
  $.ajax({
    type: "POST",
    url: "/cart/add",
    data: {
      id,
      quantity,
      size,
      color,
    },
    success: function (response) {
      checkUserValid(JSON.parse(response).status)
      if (response && JSON.parse(response).status == true) {
        updateCartHeader(response);
        Swal.fire({
          ...successPopup,
          title: "Đã thêm sản phẩm vào giỏ hàng!",
        });
      } else {
        window.location = "/auth";
      }
    },
  });
}
// update lại sản phẩm và số lượng của giỏ hàng header
function updateCartHeader(response) {
  let cartHTML = "";
  const { cart, total, totalQuantity } = JSON.parse(response);
  if (cart) {
    for (const key in cart) {
      const {
        id: productId,
        title,
        currentPrice,
        quantity,
        image,
        colors,
        colorSelected,
        sizes,
        sizeSelected,
      } = cart[key];
      cartHTML += `<div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="/product/detail/${productId}">${title}</a>
                                    </h4>
                                    <div class="cart-product-info">
                                        <span class="cart-product-qty circle active" style="background-color: ${colorSelected}; width: 15px; height: 15px; margin-left: 4px;"></span>
                                        - ${sizeSelected}
                                    </div>
                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">${quantity}</span>
                                        x ${currentPrice}đ
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="/product/detail/${productId}" class="product-image">
                                        <img src="/public/assets/images/products/${image}" alt="${title}">
                                    </a>
                                </figure>
                            </div><!-- End .product -->`;
    }
  }
  $(".dropdown-cart-products").html(cartHTML);
  if (total > -1) {
    $(".cart-total-price").html(
      `${total.toLocaleString("en-US", priceFormatOption)}đ`
    );
    $(".cart-txt").html(`${total.toLocaleString("en-US", priceFormatOption)}đ`);
  }
  if (totalQuantity > -1) {
    $(".cart-count").html(
      `${
        totalQuantity < 99
          ? totalQuantity.toLocaleString("en-US", priceFormatOption)
          : "..."
      }`
    );
  }
}
// wishlist
$(document).on('click', '.btn-wishlist', function(){
  let productId = $(this).data('productid')
  if($(this).html() == "<span>Thêm vào danh sách yêu thích</span>"){
    $(this).html("<span>Đã yêu thích</span>")
  }else{
    $(this).html("<span>Thêm vào danh sách yêu thích</span>")
  }
  $.ajax({
    type: "POST",
    url: "/wishlist/add",
    data: {
      productId,
    },
    success: function (response) {
      const { status } = JSON.parse(response);
      checkUserValid(status)
      if (status == 1) {
        updateWishlistHeader();
      } else {
        if (JSON.parse(response).errMsg) {
          Swal.fire({
            ...successPopup,
            icon: "info",
            title: JSON.parse(response).errMsg,
          });
        }
      }
    },
  });
})
function updateWishlistHeader() {
  $.ajax({
    type: "POST",
    url: "/wishlist/total",
    success: function (response) {
      if (response && JSON.parse(response).status == 1) {
        $(".wishlist-count").html(JSON.parse(response).total[0]);
      }
    },
  });
}
       
$(document).ready(function() {
  updateWishlistHeader()
});