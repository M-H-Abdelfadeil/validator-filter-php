<?php
namespace ValidatorFilterPHP\Validator;


trait Validator{
    
    public function rule($rule){
        $requests=array_keys($rule);
        $errors_validate=[];
        foreach($requests as $request){
            $rule_request=$rule[$request] ;
            $all_rules=explode("|",trim($rule_request,"|"));
            $all_rules=array_reverse($all_rules);
            foreach($all_rules as $one_rule){
                $validate=$this->call_rule($one_rule , $request);
                if($validate){
                    $errors_validate[$request]=$validate;
                }
            }
        }
        return $errors_validate;
    }

    private function  call_rule($rule,$request){
        $method=$rule;
        $class=get_class();
        if(method_exists($class,$method)){
            if($this->$method($request)){
                return $this->$method($request);
            }
        }else{
            return $this->rules_has_value($rule,$request);
        }
    }

    

    private function rules_has_value($rule,$request){
        if(substr($rule,0,10)=="min_length"){

            $min=explode(":",$rule);
            if($min[0]=="min_length"){
                $min=end($min);
                return $this->min_length($request,$min);
            }else{
                return $this->inc_error($min[0]);
            }
           

        }elseif(substr($rule,0,10)=="max_length"){
            $max=explode(":",$rule);
            if($max[0]=="max_length"){
                $max=end($max);
                return $this->max_length($request,$max);
            }else{
                return $this->inc_error($max[0]);
            }
            

        }elseif(substr($rule,0,7)=="min_val"){
            $min=explode(":",$rule);
            if($min[0]=="min_val"){
                $min=end($min);
                return $this->min_val($request,$min);
            }else{
                
                return $this->inc_error($min[0]);
            }
            

        }elseif(substr($rule,0,7)=="max_val"){

            $max=explode(":",$rule);
            if($max[0]=="max_val"){
                $max=end($max);
                return $this->max_val($request,$max);
            }else{
                return $this->inc_error($max[0]);
            }
            

        }elseif(substr($rule,0,7)=="options"){
            $options=explode(":",$rule);
            if($options[0]=="options"){
                $options=end($options);
                return $this->options($request,$options);
            }else{
                return $this->inc_error($options[0]);
            }
            

        }else{
            return $this->rules_db($request,$rule);
        }
    }



    private function rules_db($request,$rule){
        if(substr($rule,0,6)=="unique"){
            $unique=explode(":",$rule);
            if($unique[0]=="unique"){
                return $this->db_unique($request,end($unique));
            }else{
                return $this->inc_error($unique[0]);
            }
           
        }elseif(substr($rule,0,6)=="exists"){
            $exists=explode(":",$rule);
            if($exists[0]=="exists"){
                return $this->db_exists($request,end($exists));
            }else{
                return $this->inc_error($exists[0]);
            }
        }else{
            return $this->inc_error($rule);
        }
    }


    private function inc_error($rule_msg){
        $all_rules="
        <br>
        ===========================
        <br>
        <stron>The available rules are : </stron><br>
        required <br>
        number      <br>
        options:[option 1 , option 2 ,....]     <br>
        string      <br>
        ip          <br>
        email       <br>
        unique:table,column,id_column=number(optional [case update])      <br>
        exists:table,column      <br>
        max_length:value  <br>
        min_length:value  <br>
        max_val:value     <br>
        min_val:value      <br>
        url         <br>
        ";
        $msg="not found ' ".$rule_msg." ' " .$all_rules;
        if(empty($rule_msg)){
            $msg="Plase write the rule";
        }

       
        include "error.php";
        exit();
    }


}
