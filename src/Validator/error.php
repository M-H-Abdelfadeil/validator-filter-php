<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<style>
.container-error{
    background-color:#ff5050;
    border-radius:10px;
    padding:5px;
    color:#fff;
    font-family: 'Cairo', sans-serif;
    letter-spacing: 2px;
}
</style>
<body>
    <div class="container-error">
        <h3>
           Error Package ValidatorFilterPHP
            
        </h3>
        <h4>
            <?php
                if($msg){
                    echo $msg;
                }
            ?>
        </h4>
    </div>
    
</body>
</html>