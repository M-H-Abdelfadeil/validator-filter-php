<?php
namespace ValidatorFilterPHP;

class FilterPHP{
    public function string($data){
        return filter_var($data,FILTER_SANITIZE_STRING);
        
    }

    public function num_int($data){
        return filter_var($data,FILTER_SANITIZE_NUMBER_INT);
        
    }

    public function num_float($data,$flag=false){
       if($flag=='.'){

           return filter_var($data,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
      
        }elseif($flag==','){

            return filter_var($data,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_THOUSAND);
      
        }elseif($flag=='e' || $flag=='E'){

            return filter_var($data,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_SCIENTIFIC);
       
        }elseif($flag == false ){
            return filter_var($data,FILTER_SANITIZE_NUMBER_FLOAT);
          
       }else{

            $msg= "the flag ' ".$flag." ' not found";
            include 'Validator/error.php';
            exit();

       }
        
        
    }

    public function email($data){
        return filter_var($data,FILTER_SANITIZE_EMAIL);
        
    }

    
    public function url($data){
        
        return filter_var($data,FILTER_SANITIZE_URL);
        
    }
    
    public function encoded($data){
        return filter_var($data,FILTER_SANITIZE_ENCODED);
        
    }

    public function magic_quotes($data){
        return filter_var($data,FILTER_SANITIZE_MAGIC_QUOTES);

    }

    public function special_char($data){
        return filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);

    }

    public function stripped($data){
        return filter_var($data,FILTER_SANITIZE_STRIPPED);

    }
}

