<?php
/**-------------------------------------------|
    Created: 19/09/2016
    Author: Guy Pensart
    URL: http://guypensart.be
|-------------------------------------------**/

// todo: refill inputs after submit when validation fails
// todo: Change titel when validation fails (errorcheck)

include 'FormValidatorClass.php';

$placeholder =
    [
        'name'=>'Placeholder name',
        'email'=>'Placeholder email',
        'message'=>'Placeholder message'
    ];

(empty($_POST))
    ?   $validate = new FormValidatorClass(array())
    :   ($validate = new FormValidatorClass($_POST))
    &&  $validate
        ->item('name')->required('Name is required')->setValid()
        ->item('email')->required('Name is required')->setValid()
        ->item('message')->required('Name is required')->setValid()
        ->clearFields();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <title>PHP Form validator class</title>
    <style>
        html { font-family: sans-serif; }
        h1 { text-align: center; }
        form { min-width: 500px; }
        input, textarea { padding: .5em; width: 100%; margin-bottom: 20px; }
        textarea { height: 11em; }
        .debug { color: hsl(0,0%,95%); text-align: center; margin-bottom: 30px;}
        .debug-passed,.debug-error { margin: 5px; padding: 5px 10px; border-radius: 3px; }
        .debug-passed { background-color: hsl(120,80%, 40%); }
        .debug-error { background-color: hsl(0,80%, 40%); }
        .wrapper { display: table; margin: 0 auto; display: table; }
    </style>
</head>
    <body>
    <h1><?= (!$_POST) ? 'Contact me' : ((!$validate->errorsFree()) ? 'Form failed' : 'Form success'); ?></h1>
    <div class="debug"><?= (!$_POST) ? '' : $validate->debug(); ?></div>
    <div class="wrapper">
        <form method="POST">
            <input type="text" name="name" placeholder=<?= '"'.$placeholder['name'].'"';?> >
            <input type="text" name="email" placeholder=<?= '"'.$placeholder['email'].'"';?> >
            <textarea name="message"><?= (!$_POST) ? $placeholder['message'] : $validate->getValue('message'); ?></textarea>
            <input type="submit" >
        </form>
    </div>
    </body>
</html>