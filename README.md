# Validator And Filter PHP

### [install](#installation)
### [Confige File](#ConfigeFile)
### [Validator](#Validate)

[ - Syntax](#Syntax)<br>
[ - NotesSyntax](#NotesSyntax)<br>
[ - string](#string)<br>
[ - url](#url)<br>
[ - required](#required)<br>
[ - options](#options)<br>
[ - ip](#ip)<br>
[ - email](#email)<br>
[ - max_length](#max_length)<br>
[ - min_length](#min_length)<br>
[ - max_val](#max_val)<br>
[ - min_val](#min_val)<br>
[ - uniqueAndExists](#uniqueAndExists)<br>
[ - unique](#unique)<br>
[ - exists](#exists)<br>
<br><br>
### [Filter](#Filters)

[-string](#string)<br>
[-num_int](#num_int)<br>
[-num_float](#num_float)<br>
[-email](#email)<br>
[-url](#url)<br>
[-encoded](#encoded)<br>
[-magic_quotes](#magic_quotes)<br>
[-special_char](#special_char)<br>


## installation

<br>
1- composer requier  mahmoud.abdelfadeil/validator-filter-php
<br>



## ConfigeFile
create config file  Through the following command : <br>
<p style="color:#3e7c98">
php vendor/mahmoud-abdelfadeil/validator-filter-php/src/Validator/create-file-config.php
</p>

Or create a config file by writing these lines into the composer.json file , Then command
<p style="color:#3e7c98">
composer dump-autoload
</p>

```json
{
    
    "scripts": {
        "post-autoload-dump": [
           "php  vendor/mahmoud-abdelfadeil/validator-filter-php/src/Validator/create-file-config.php"
        ]
    }
}
```

Then the file is created config/validator-filter-config.php


```php
return [
    // config database
    "db_host"=>"localhost",
    "db_connection"=>"mysql",
    "db_name"=>"filter-validate-php",
    "db_user"=>"root",
    "db_password"=>"",



    // config langauge [ar - en]
    "lang"=>'en'
];
```
<br>

It is a settings file that makes settings for Database and language settings


## Validate 
<br>

It is intended to verify the value <br>

There are several functions of them <br>

### Syntax

```php
/*
$arr=[
    request name = > rules
]
*/
// example
include 'vendor/autoload.php';
$validate=new ValidatorFilterPHP\ValidatorPHP();
$rules=[
    'name'=>'required|string|max_length:100|min_length:5',
    'age'=>'required|number|max_val:60|min_val:10',
    'email'=>'required|unique:users,email'
];

if(isset($_POST['submit'])){
    $validate->Validator($rules);
    if($validate->has_error_validate()){
        echo "<pre>";
        print_r( $validate->has_error_validate());
    }else{
        // next request
    }
}


```
### NotesSyntax

<br>

**As we noticed in the previous example, we write the name of the request, then the rules to be verified, and each rule is separated by using the ' | '**

<br><br>

**There are many rules that we need to write a value, for example the max_length, which means the minimum number of characters, and the rule and value are separated using the '  :  '**
<br><br>

### Rules 

#### string
Check the value if it is textual or not
<br>

#### number
Check if the value is a number or not

#### url

Check if the value is a url or not
#### required

Check if the value is empty or not


#### options

It forces the user to enter the specified values ​​into the options<br>
From a rule that takes specified values ​​but is written this way : 

options:[option 1 , option 2 , .......]

```php
// example 
'category'=>'required|options:[car,laptop,mobile]'
```

#### ip

Check if the value is a ip  or not



#### email

Check if the value is a email or not

#### max_length

Checks the maximum amount of characters allowed

#### min_length

Check the minimum number of characters allowed

**example**
```php
// maximum length  100  characters
// minimum length  5    characters

'name'=>'required|max_length:100|min_length:5'
```

#### max_val

Check the maximum allowed value

#### min_val

Check the minimum allowed value


```php
// maximum value  60
// minimum value  20    

'age'=>'required|max_val:60|min_val:20'
```

<br>
**Note:The max_length or min_length is used with the string. The max_val and min_val are used with numbers . In addition, they check if it is a number or not**


### uniqueAndExists

Before dealing with either of them, make the database settings from the
**config/validator-filter-config.php**
```php
return [
    // config database
    "db_host"=>"localhost",
    "db_connection"=>"mysql",
    "db_name"=>"filter-validate-php",
    "db_user"=>"root",
    "db_password"=>"",



    // config langauge
    "lang"=>'en'
];
```
<br><br>
#### unique
Verify that the value is not present in the data base<br>
Synax : <br>
unique:table,column
```php
// example  

'email'=>'required|unique:users,email'
```
<br>
Here, verify that email does not already exist in Databases<br>
**If modified, the identifier is sent with the unique identifier to check all rows except for the sender and write in this way The id field name for example tbl_id and then the value that way tbl_id = 5**

```php
// example  if update data

'email'=>'required|unique:users,email,tbl_id=5'
``` 

**If the field is named id, you only need to enter the value**
```php
'email'=>'required|unique:users,email,5'
``` 

<br><br>
#### exists
Synax : <br>
exists:table,column
<br>
Verify that the value is present in the data base
```php
// example  

'email'=>'required|unique:users,email'
```
<br>
<br><br>


## Filters
a data filter <br>
Syntax : <br>
$obj->functionName($data)

```php
// example
$filter=new ValidatorFilterPHP\FilterPHP();
$str="<script>mahmoud abdelfadeil</script>";
$str_filter =  $filter->string($str);

echo $str_filter ;

// output  = mahmoud abdelfadeil
```

##functions 

#### string

```php
$str="<script>mahmoud abdelfadeil</script>";

$str_filter =  $filter->string($str);

echo $str_filter ;

// output  = mahmoud abdelfadeil
```
<br><br>
#### num_int 
number integer 
```php
$data="<script>mahmoud 1299 abdelfadeil</script>";

$data_filter =  $filter->num_int($data);

echo $data_filter ;

// output  = 1299
```


<br><br>
#### num_float 
number float 
```php
$data="12.99";

$data_filter =  $filter->num_float($data);

echo $data_filter ;

// output  = 1299

```

**However, this function takes a second argument, which is the flag** <br>
**Flags  =  e or E or , or .**

```php
$data="12.99";

$data_filter =  $filter->num_float($data,'.');

echo $data_filter ;

// output  = 12.99

```

```php
$data="12,99";

$data_filter =  $filter->num_float($data,',');

echo $data_filter ;

// output  = 12,99

```

```php
$data_1="12ee9e9";

$data_1_filter =  $filter->num_float($data_1);

echo $data_1_filter ;

// output data 1   = 1299

$data_2="12ee9e9E";

$data_2_filter =  $filter->num_float($data_2,'e');

echo $data_2_filter ;

// output data 2   =  12ee9e9E


$data_3="12ee9e9E";

$data_3_filter =  $filter->num_float($data_3,'E');

echo $data_3_filter ;

// output data 3   =  12ee9e9E

```


<br><br>
#### email 

```php

$data="mahmoud .  €¶€€¶€€¶€  abdelfadeil@test.test";

$data_filter =  $filter->email($data);

echo $data_filter ;

// output data    =  mahmoud.abdelfadeil@test.test
 
```

<br><br>
#### url 

```php

$data="mahmoud-abdelfadeil.€¶€¶€me";

$data_filter =  $filter->url($data);

echo $data_filter ;

// output data    =  mahmoud-abdelfadeil.me
 
```

<br><br>
#### encoded 

```php

$data="mahmoud-abdelfadeil.€¶€¶€me";

$data_filter =  $filter->encoded($data);

echo $data_filter ;

// output data   =   mahmoud-abdelfadeil.%E2%82%AC%C2%B6%E2%82%AC%C2%B6%E2%82%ACme
 
```

<br><br>
#### magic_quotes 

```php

$data="mahmoud's here";

$data_filter =  $filter->magic_quotes($data);

echo $data_filter ;


// output data =  mahmoud\'s here
 
```
<br><br>
#### special_char 

```php
$data="<b>mahmoud abdelfadeil</b>";

$data_filter =  $filter->special_char($data);

echo $data_filter ;

// output data = &#60;b&#62;mahmoud abdelfadeil&#60;/b&#62;
```


