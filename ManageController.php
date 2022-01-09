<?php
    require_once 'src/models/ManageModels.php';

    class ManageController {
        public function index() {
            $blood = new Blood();
            $bloods = $blood->indexABC();
            require_once 'src/views/manage/index.php';
        }

        public function add() {
            $error = '';
            if (isset($_POST['submit'])) {
                $name = $_POST['txtName'];
                $year = $_POST['txtYear'];
                $linhvuc = $_POST['txtLinhvuc'];
                $nhiemvu = $_POST['txtNhiemvu'];
                $coquanthuchien = $_POST['txtCoquanthuchien'];
                
                $blood = new Blood();
                $bloodArr = [
                    'name' => $name,
                    'year' => $year,
                    'linhvuc' => $linhvuc,
                    'nhiemvu' => $nhiemvu,
                    'coquanthuchien' => $coquanthuchien
                   
                ];

                $isInsert = $blood->insert($bloodArr);
                if ($isInsert) {
                    $_SESSION['success'] = "Thêm mới thành công";
                }
                else {
                    $_SESSION['error'] = "Thêm mới thất bại";
                }
                header("Location: index.php?controller=manage&action=index");
                exit();
            }
            //gọi view
            require_once 'src/views/manage/add.php';
        }

        public function edit() {
            if (!isset($_GET['id'])) {
                $_SESSION['error'] = "Tham số không hợp lệ";
                header("Location: index.php?controller=manage&action=index");
                return;
            }

            if (!is_numeric($_GET['id'])) {
                $_SESSION['error'] = "Id phải là số";
                header("Location: index.php?controller=manage&action=index");
                return;
            }

            $id = $_GET['id'];
            //gọi model để lấy ra đối tượng sách theo id
            $bloodModel = new Blood();
            $blood = $bloodModel->getBloodById($id);

            //xử lý submit form, lặp lại thao tác khi submit lúc thêm mới
            // $error = '';
            if (isset($_POST['submit'])) {
                $name = $_POST['txtName'];
                $year = $_POST['txtYear'];
                $linhvuc = $_POST['txtLinhvuc'];
                $nhiemvu = $_POST['txtNhiemvu'];
                $coquanthuchien = $_POST['txtCoquanthuchien'];
              
                //check validate dữ liệu
            
                //xử lý update dữ liệu vào hệ thống
                $bloodModel = new Blood();
            
                $bloodArr = [
                    'id' => $id,
                    'name' => $name,
                    'year' => $year,
                    'linhvuc' => $linhvuc,
                    'nhiemvu' => $nhiemvu,
                    'coquanthuchien' => $coquanthuchien
                   
                ];
            

                $isUpdate = $bloodModel->update($bloodArr);
            
                if ($isUpdate) {
                    $_SESSION['success'] = "Update bản ghi #$id thành công";
                }
                else {
                    $_SESSION['error'] = "Update bản ghi #$id thất bại";
                }
                header("Location: index.php?controller=manage&action=index");
                exit();
                
            }
            //truyền ra view
            require_once 'src/views/manage/edit.php';

        }

        public function delete() {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                header("Location: index.php?controller=manage&action=index");
                exit();
            }
    
            $blood = new Blood();
            $isDelete = $blood->delete($id);
    
            if ($isDelete) {
                $_SESSION['success'] = "Xóa bản ghi #$id thành công";
            }
            else {
                $_SESSION['error'] = "Xóa bản ghi #$id thất bại";
            }
    
            header("Location: index.php?controller=manage&action=index");
            exit();
        }

    }
?>