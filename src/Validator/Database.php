<?php
namespace ValidatorFilterPHP\Validator;
trait Database{
    public function db(){
        $config=$this->config_DB();

        $db_host        =$config['db_host'];
        $db_connection  =$config['db_connection'];
        $db_name        =$config['db_name'];
        $db_user        =$config['db_user'];
        $db_password    =$config['db_password'];

        try {
            $conn = new \PDO("$db_connection:host=$db_host;dbname=$db_name", $db_user, $db_password,
                array(
                    \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC
                ));
            return $conn;
        } catch(PDOException $e) {
            echo "Connection Error Database: " . $e->getMessage();
            exit();
        }

    }
    public function db_unique($request,$data){
        $this->chk_request($request);
        $data=trim($data,",");
        $data=explode(",",$data);
        if(!isset($data[0]))return "unique params ' table,column '  required";
        if(!isset($data[1]))return "unique params ' column '  required";
        // check tables
        $this->chk_found_table($data[0]);
        // check found column 
        $this->chk_found_column($data[1],$data[0]);
        $stm="SELECT * FROM $data[0]  WHERE $data[1] = '$_REQUEST[$request]'";
        if(isset($data[2])){
           $col='id';
           $val=$data[2];
           if(!is_numeric($data[2])) {
                $data_not=explode('=',$data[2]);
                $col=$data_not[0];
                $val=$data_not[1];
           }
           $stm="SELECT * FROM $data[0]  WHERE $data[1] = '$_REQUEST[$request]' AND $col != '$val'";
        }

        
        $tbl_data = $this->chk_found_data($stm);

        if($tbl_data){
            return $this->lang['unique'];
        }
    }

    public function db_exists($request,$data){
        $this->chk_request($request);
        $data=trim($data,",");
        $data=explode(",",$data);
        if(!isset($data[0]))return "exists params ' table,column '  required";
        if(!isset($data[1]))return "exists params ' column '  required";
        
        // check tables
        $this->chk_found_table($data[0]);
         // check found column 
         $this->chk_found_column($data[1],$data[0]);
        // check data

        $stm="SELECT * FROM $data[0]  WHERE $data[1] = '$_REQUEST[$request]'";
        $tbl_data = $this->chk_found_data($stm);
        if(!$tbl_data){
           return   $this->lang['exists'] . " ' ". $data[0]. " ' ";
        }
    }

    private function config_DB(){
     $file_config=$_SERVER['DOCUMENT_ROOT']."/config/validator-filter-config.php";
      if(!file_exists($file_config)){
            if(!is_dir($_SERVER['DOCUMENT_ROOT'].'/config')){
                mkdir($_SERVER['DOCUMENT_ROOT'].'/config');
            }
            $content_config=file_get_contents(__DIR__."/config.php");
            $handle_file = fopen($file_config, "w");
            fwrite($handle_file,$content_config);
            echo "create file config ";
        }
        return include  $file_config;
    }


    private function chk_found_table($table){
        $stm="SHOW TABLES LIKE '$table'";
        $found_table=$this->chk_found_data($stm);
        if(!$found_table){
            $msg="The table  ' " . $table . " ' Not found";
            include 'error.php';
            exit();
        }
    }
    private function chk_found_column($column,$table){
        $stm="SELECT * FROM $table LIMIT 1";
        $columns=$this->chk_found_data($stm);
        if($columns){
            $columns=array_keys($columns[0]);
            $found=false;
            foreach($columns as $c){
                if($c==$column){
                    $found=true;
                }
            }
            if(!$found){
                $msg="The coulumn   ' " . $column . " ' Not found in table ' " . $table . " ' ";
                include 'error.php';
                exit();
            }
        }
        
    }
    

    private function chk_found_data($stm){
        $conn=$this->db();
        $query = $conn->prepare($stm);
        $query->execute();
        return  $query->fetchAll();
    }

   

    




}