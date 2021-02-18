<?php
namespace ValidatorFilterPHP\Validator;
use ValidatorFilterPHP\Validator\RuleHandler;


trait RuleValidator{
    use RuleHandler;
    public  function required($request){

        return $this->handler_required($request);

    }
    public function max_length($request,$max){
       
        return $this->handler_max_length($request,$max);
        
    }
    public function min_length($request,$min){

        return $this->handler_min_length($request,$min);
        
    }

    public function max_val($request,$max){

        return $this->handler_max_val($request,$max);

    }

    public function min_val($request,$min){

        return $this->handler_min_val($request,$min);

    }

    public function string($request){

        return $this->handler_string($request);
        
    }
    public function email($request){

        return $this->handler_email($request);
    }

    public function number($request){

        return $this->handler_number($request);

    }

    public function url($request){

        return $this->handler_url($request);
        
    }

    public function ip($request){

        return $this->handler_ip($request);

    }

    public function options($request,$options){

        return $this->handler_options($request,$options);

    }


}