<!DOCTYPE html>
<html dir='<?php if (isset($_COOKIE['lang'])) {
                if ($_COOKIE['lang'] == 'arapca') {
                    echo 'rtl';
                } else {
                    echo 'ltr';
                }
            } elseif (!isset($_COOKIE['lang'])) {
                setcookie("lang", "turkce");
                echo 'ltr';
            } 
    ?>
'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo getTitle(); ?></title>
</head>
<body>
    
