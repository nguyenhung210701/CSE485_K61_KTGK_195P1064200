<?php
    require_once 'src/config/database.php';

    class Blood {
        public $id;
        public $name;

        public function connectDb() {
            $connection = mysqli_connect(DB_HOST,
                DB_USERNAME, DB_PASSWORD, DB_NAME);
            if (!$connection) {
                die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
            }
    
            return $connection;
        }

        public function insert($blood = []) {
            $connection = $this->connectDb();
            //tạo và thực thi truy vấn
            $queryInsert = "INSERT INTO duan(`tenduan`, `namthuchien`, `linhvuc`, `nhiemvu`, coquanthuchien) 
            VALUES ('{$blood['name']}', '{$blood['year']}', '{$blood['linhvuc']}', 
            '{$blood['nhiemvu']}', '{$blood['coquanthuchien']}')";
            $isInsert = mysqli_query($connection, $queryInsert);
            $this->closeDb($connection);

            return $isInsert;
        }

        public function indexABC() {
            $connection = $this->connectDb();
            //truy vấn
            $querySelect = "SELECT * FROM duan";
            $results = mysqli_query($connection, $querySelect);
            $bloods = [];
            if (mysqli_num_rows($results) > 0) {
                $bloods = mysqli_fetch_all($results, MYSQLI_ASSOC);
            }

            $this->closeDb($connection);
    
            return $bloods;
        }

        public function closeDb($connection = null) {
            mysqli_close($connection);
        }

        public function getBloodById($id = null) {
            $connection = $this->connectDb();
            $querySelect = "SELECT * FROM duan WHERE maduan=$id";
            $results = mysqli_query($connection, $querySelect);
            $blood = [];
            if (mysqli_num_rows($results) > 0) {
                $bloods = mysqli_fetch_all($results, MYSQLI_ASSOC);
                $blood = $bloods[0];
            }
            $this->closeDb($connection);
    
            return $blood;
        }

        public function update($blood) {
          
            $connection = $this->connectDb();
            $queryUpdate = "UPDATE duan SET `tenduan` = '{$blood['name']}', `namthuchien` = '{$blood['year']}',  `linhvuc` = '{$blood['linhvuc']}'
            ,  `nhiemvu` = '{$blood['nhiemvu']}',  `coquanthuchien` = '{$blood['coquanthuchien']}'  WHERE `maduan` = {$blood['id']} ";
            $isUpdate = mysqli_query($connection, $queryUpdate);
            $this->closeDb($connection);
    
            return $isUpdate;
        }

        public function delete($id = null) {
            $connection = $this->connectDb();
    
            $queryDelete = "DELETE FROM duan WHERE maduan = $id";
            $isDelete = mysqli_query($connection, $queryDelete);
    
            $this->closeDb($connection);
    
            return $isDelete;
        }
    }
 ?>