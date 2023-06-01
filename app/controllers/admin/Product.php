<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
            echo json_encode([
                'status' => 1,
                'products' => $products
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
            $res = $this->model->deleteOption($id);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
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
    public function import()
    {
        if (!empty($_FILES)) {
            $ext = strtolower(pathinfo($_FILES['import']['name'], PATHINFO_EXTENSION));
            // echo $ext;
            if ($ext != 'xlsx') {
                echo json_encode([
                    'status' => 0,
                    'errMsg' => 'Vui lòng chọn file có đuôi xlsx'
                ]);
                return;
            }
            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($_FILES['import']['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = array();
                for ($column = 'A'; $column <= $highestColumn; $column++) {
                    // Get the cell value
                    $cellValue = $worksheet->getCell($column . $row)->getValue();
                    $rowData[] = $cellValue;
                }
                $res = $this->model->addProduct($rowData[0], $rowData[1], $rowData[2], $rowData[4], $rowData[3]);
                if (empty($res)) {
                    echo json_encode([
                        'status' => 0,
                        'errMsg' => 'Có lỗi xảy ra trong quá trình nhập dữ liệu'
                    ]);
                    return;
                }
            }
            echo json_encode([
                'status' => 1,
                'products' => $this->model->getProductsList(null, true)
            ]);
            return;
        }
    }
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Tên sản phẩm');
        $sheet->setCellValue('B1', 'Giá gốc');
        $sheet->setCellValue('C1', 'Giảm giá(%)');
        $sheet->setCellValue('D1', 'Giá sau giảm');
        $sheet->setCellValue('E1', 'Mô tả');
        $sheet->setCellValue('F1', 'Số lượt đánh giá');
        $sheet->setCellValue('G1', 'Số sao trung bình');
        $sheet->setCellValue('H1', 'Số lượng đã bán');
        $products = $this->model->getProductsList(null, true);
        $current_index = 2;
        foreach ($products as $product) {
            $sheet->setCellValue('A' . $current_index, $product['title']);
            $sheet->setCellValue('B' . $current_index, $product['originalPrice']);
            $sheet->setCellValue('C' . $current_index, $product['salePercent']);
            $sheet->setCellValue('D' . $current_index, $product['currentPrice']);
            $sheet->setCellValue('E' . $current_index, $product['description']);
            $sheet->setCellValue('F' . $current_index, $product['reviewCount']);
            $sheet->setCellValue('G' . $current_index, $product['rating']);
            $sheet->setCellValue('H' . $current_index, $product['sold']);
            $current_index++;
        }
        $writer = new Xlsx($spreadsheet);
        $file_name = 'danh_sach_san_pham_' . date("Y_m_d_H_i_s") . '.xlsx';
        $filePath = 'export/' . $file_name;
        $writer->save($filePath);
        ob_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Pragma: no-cache');
        header('Expires: 0');
        readfile($filePath);
        unlink($filePath);
        ob_end_clean();
    }
}
