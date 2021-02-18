<?php
namespace ValidatorFilterPHP\Validator;

trait RuleHandler{

    
    public function handler_required($request){
       $this->chk_request($request) ;
       if(empty($_REQUEST[$request])){
            return $this->lang['required'];
       }
    }
    public function handler_max_length($request,$max){
      
        $this->chk_request($request) ;
        if(strlen($_REQUEST[$request])>$max){
            
            return $this->lang['max_length'] . " ' " .$max.  " ' ";
        }
        
    }
    public function handler_min_length($request,$min){
        $this->chk_request($request) ;
        if(strlen($_REQUEST[$request])<$min){
            return $this->lang['min_length'] . " ' " .$min.  " ' ";
        }
    }
    public function handler_max_val($request,$max){
        $this->chk_request($request) ;
        if(is_numeric($_REQUEST[$request])){
            if($_REQUEST[$request]>$max){
                return $this->lang['max_val']. " ' " .$max.  " ' ";
            }
        }else{
            return $this->lang['number'];
        }
            
    }
    public function handler_min_val($request,$min){
        $this->chk_request($request) ;
        if(is_numeric($_REQUEST[$request])){
            if($_REQUEST[$request]<$min){
                return $this->lang['min_val'] . " ' " .$min.  " ' ";
            }
        }else{
            return $this->lang['number'];
        }
            
    }
    public function handler_string($request){
        $this->chk_request($request) ;
        if(isset($_REQUEST[$request])){
            if(!is_string($_REQUEST[$request])){
                return $this->lang['string'];
            }
           
        }
    }
    public function handler_email($request){
        $this->chk_request($request) ;
        if(filter_var($_REQUEST[$request],FILTER_VALIDATE_EMAIL)==false){
            return $this->lang['email'];
        }
    }
    public function handler_number($request){
        $this->chk_request($request) ;
        
        if(!is_numeric($_REQUEST[$request])){
            return $this->lang['number'];
        }
        
    }
    public function handler_url($request){
        $this->chk_request($request) ;
        if(filter_var($_REQUEST[$request],FILTER_VALIDATE_URL)==false){
            return $this->lang['url'];
        }
    }
    public function handler_ip($request){
        $this->chk_request($request) ;
        if(filter_var($_REQUEST[$request],FILTER_VALIDATE_IP)==false){
            return $this->lang['ip'];
        }

    }

    public function handler_options($request,$options){
        $this->chk_request($request) ;
        $found=false;
        
        $options=trim($options,"[],");
        $data_options=$options;
        $options=explode(',',$options);
        
        foreach($options as $option){
            if($_REQUEST[$request]==$option){
                $found=true;
            }
        }
        if(!$found){
            
            return  $this->lang['options'].  " ' ".$data_options . " ' ";
        }
    

        
    }



    private function chk_request($request){
        if(!isset($_REQUEST[$request])){
            $msg="The Request ' ".$request." ' Not Found";
            include 'error.php';
            exit();
            
        }
    }






}