<?php
class Product extends Controller
{
    public $model = null;
    private $data = [];
    public function __construct()
    {
        $this->model = new ProductModel();
    }
    public function index()
    {
        $this->data['title'] = 'Product';
        $this->data['subcontent']['controller'] = 'product';
        $this->data['subcontent']['products'] = $this->model->getProductsList(null, true);
        $this->data['subcontent']['categories'] = (new CategoryModel())->getCategoriesList();
        $this->data['content'] = 'admin/pages/product/list';
        $this->render('layouts/admin', $this->data);
    }
    public function filter()
    {
        if (!empty($_POST)) {
            $products = $this->model->getProductFilter($_POST);
            if (!empty($products)) {
                echo json_encode([
                    'status' => 1,
                    'products' => $products
                ]);
                return;
            }
            echo json_encode([
                'status' => 0,
                'errMsg' => 'Danh mục chưa có sản phẩm...'
            ]);
            return;
        }
    }
    public function detail($id)
    {
        $this->data['title'] = 'Product detail';
        $this->data['subcontent']['controller'] = 'product';
        $product = $this->model->getProductById($id, true);
        if (!empty($product)) {
            $this->data['subcontent']['product'] = $product;
            $this->data['subcontent']['productOptions'] = $this->model->getProductOptions($id, false);
            $this->data['subcontent']['imagesGallery'] = $this->model->getProductImage($id);
            $categoryModel = new CategoryModel();
            $this->data['subcontent']['category'] = $categoryModel->getCategoryById($product['categoryId']);
        } else {
            $this->loadError();
        }
        $this->data['content'] = 'admin/pages/product/detail';
        $this->render('layouts/admin', $this->data);
    }

    public function deleteImage()
    {
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $productId = $_POST['productId'];
            $res = $this->model->deleteImage($id);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                    'images' => $this->model->getProductImage($productId)
                ]);
                return;
            }
        }
    }
    public function uploadProductImages()
    {
        if (!empty($_POST)) {
            $images = $_FILES['images'];
            $productId = $_POST['productId'];
            $check = $this->uploadMultiImage($images, 'products');
            if ($check) {
                echo json_encode([
                    'status' => 0,
                    'uploadErr' => $check
                ]);
                return;
            }
            $res = $this->model->addProductImages($productId, $images);
            if ($res !== false) {
                echo json_encode([
                    'status' => 1,
                    'images' => $this->model->getProductImage($productId)
                ]);
                return;
            }
        }
    }
    //  product option
    public function addOption($id = null)
    {
        if (!empty($id)) {
            if (!empty($_POST)) {
                $color = $_POST['color'];
                $size = $_POST['size'];
                $quantity = $_POST['quantity'];
                $check = $this->model->checkOptionExisted($id, $color, $size);
                if (!empty($check)) {
                    if ($check['deleted'] == 0) {
                        echo json_encode([
                            'status' => 0,
                            'errMsg' => 'Thuộc tính này đã tồn tại!'
                        ]);
                        return;
                    }
                    if ($check['deleted'] == 1) {
                        $res = $this->model->restoreOption($check['optionId'], $quantity);
                        if (!empty($res)) {
                            echo json_encode([
                                'status' => 1,
                            ]);
                            return;
                        }
                    }
                } else {
                    $res = $this->model->addOption($id, $color, $size, $quantity);
                    if (!empty($res)) {
                        echo json_encode([
                            'status' => 1,
                        ]);
                        return;
                    }
                }
            } else {
                $this->data['title'] = 'Add option';
                $this->data['subcontent']['controller'] = 'product';
                $this->data['subcontent']['editMode'] = false;
                $this->data['subcontent']['colors'] = (new ColorModel())->getAllColors();
                $this->data['subcontent']['productId'] = $id;
                $this->data['content'] = 'admin/pages/product/form-option';
                $this->render('layouts/admin', $this->data);
            }
        }
    }
    public function editOption($id = null, $optionId = null)
    {
        if (!empty($id)) {
            if (!empty($_POST)) {
                $optionId = $_POST['optionId'];
                $color = $_POST['color'];
                $size = $_POST['size'];
                $quantity = $_POST['quantity'];
                $check = $this->model->checkOptionExisted($id, $color, $size, $optionId);
                if (!empty($check)) {
                    echo json_encode([
                        'status' => 0,
                        'errMsg' => 'Thuộc tính đã tồn tại'
                    ]);
                    return;
                } else {
                    $this->model->editOption($optionId, $color, $size, $quantity);
                    echo json_encode([
                        'status' => 1,
                    ]);
                    return;
                }
            } else if (!empty($optionId)) {
                $this->data['title'] = 'Edit option';
                $this->data['subcontent']['controller'] = 'product';
                $this->data['subcontent']['editMode'] = true;
                $this->data['subcontent']['productId'] = $id;
                $this->data['subcontent']['colors'] = (new ColorModel())->getAllColors();
                $option = $this->model->getOptionById($optionId, false);
                if (!empty($option)) {
                    $this->data['subcontent']['option'] = $option;
                } else {
                    $this->loadError();
                }
                $this->data['content'] = 'admin/pages/product/form-option';
                $this->render('layouts/admin', $this->data);
            } else {
                $this->loadError();
            }
        }
    }
    public function deleteOption()
    {
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $productId = $_POST['productId'];
            $res = $this->model->deleteOption($id);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                    'options' => $this->model->getProductOptions($productId,false)
                ]);
                return;
            }
        }
    }
    public function add()
    {
        if (!empty($_POST)) {
            $salePercent = $_POST['salePercent'] >= 100 ? 100 : $_POST['salePercent'];
            $check = $this->model->checkProductExisted($_POST['title']);
            if (!empty($check)) {
                echo json_encode([
                    'status' => 0,
                    'errMsg' => 'Sản phẩm đã tồn tại'
                ]);
                return;
            }
            $res = $this->model->addProduct($_POST['title'], $_POST['originalPrice'], $salePercent, $_POST['desc'], $_POST['categoryId']);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1
                ]);
                return;
            }
        } else {
            $this->data['title'] = 'Add product';
            $this->data['subcontent']['controller'] = 'product';
            $this->data['subcontent']['editMode'] = false;
            $this->data['content'] = 'admin/pages/product/form';
            $this->render('layouts/admin', $this->data);
        }
    }
    public function edit($id = null)
    {
        if (!empty($_POST)) {
            $salePercent = $_POST['salePercent'] >= 100 ? 100 : $_POST['salePercent'];
            $check = $this->model->checkProductExisted($_POST['title'], $_POST['id']);
            if (!empty($check)) {
                echo json_encode([
                    'status' => 0,
                    'errMsg' => 'Sản phẩm đã tồn tại'
                ]);
                return;
            }
            $this->model->editProduct($_POST['id'], $_POST['title'], $_POST['originalPrice'], $salePercent, $_POST['desc'], $_POST['categoryId']);
            echo json_encode([
                'status' => 1
            ]);
            return;
        } else if (!empty($id)) {
            $this->data['title'] = 'Edit product';
            $this->data['subcontent']['controller'] = 'product';
            $this->data['subcontent']['editMode'] = true;
            $product = $this->model->getProductById($id, true);
            if (!empty($product)) {
                $this->data['subcontent']['product'] = $product;
            } else {
                $this->loadError();
            }
            $this->data['content'] = 'admin/pages/product/form';
            $this->render('layouts/admin', $this->data);
        } else {
            $this->loadError();
        }
    }
    public function delete()
    {
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $res = $this->model->deleteProduct($id);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                    'products' => $this->model->getProductsList(null, true)
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        }
    }
    public function toggle()
    {
        if (!empty($_POST['id'])) {
            $productId = $_POST['id'];
            $show = $_POST['show'];
            $res = $this->model->showHideProduct($productId, $show);
            if ($res !== false) {
                echo json_encode([
                    'status' => 1,
                    'products' => $this->model->getProductsList(null, true)
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        }
    }
}
