
<?php 
    echo '<pre>';
    print_r($wishlist);
    echo '</pre>';
?>
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách yêu thích</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row cart-wrapper">

                <?php
                if (count($wishlist) > 0) :
                ?>
                    <form action="" method="post" id="cart-form" class="col-lg-12">
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá gốc</th>
                                    <th>Giảm giá</th>
                                    <th>Giá hiện tại</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="wishlist-tbody">
                                <?php
                                $productModel = new ProductModel();
                                if (!empty($wishlist)) :
                                    foreach ($wishlist as $key => $item) :
                                        $product = $productModel->getProductById($item['productId']);
                                        $image = $productModel->getProductImage($product['productId'],1)[0]['image'];
                                ?>
                                        <tr>
                                            <td class="product-col">
                                                <input type="hidden" name="id[]" value="<?= $item['productId'] ?>">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $image?>" alt="Product image">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a href="/product/detail/<?= $product['productId'] ?>"><?= strlen($product['title']) > 20 ? substr($product['title'], 0, 20) . '...' : $product['title'] ?></a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td><?=number_format($product['originalPrice'])?>đ</td>
                                            <td><?=$product['salePercent']?>%</td>
                                            <td><?=number_format($product['currentPrice'])?>đ</td>
                                            <td class="remove-col"><button type="button" class="btn-remove" onclick="deleteWishlistItem('<?= $product['productId'] ?>')"><i class="icon-close"></i></button></td>
                                        </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table><!-- End .table table-wishlist -->

                        <div class="cart-bottom">
                            <a href="/product" class="btn btn-outline-primary">Tiếp tục mua sắm</a>
                            <button type="button" class="btn-clear-cart btn btn-outline-dark-2"><span>Xóa tất cả sản phẩm</span><i class="icon-refresh"></i></button>
                        </div><!-- End .cart-bottom -->
                    </form><!-- End .col-lg-9 -->
                <?php endif; ?>
                <?php if (count($wishlist) <= 0) : ?>
                    <div class="m-auto text-center">
                        <h2 class="">Chưa có sản phẩm nào trong danh sách yêu thích của bạn</h2>
                        <a href="/product" class="btn btn-outline-primary">Mua sắm ngay</a>
                    </div>
                <?php endif; ?>
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->
