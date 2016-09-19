<?php
/**-------------------------------------------|
    Created: 19/09/2016
    Author: Guy Pensart
    URL: http://guypensart.be
|-------------------------------------------**/

include 'FormValidatorClass.php';

$placeholder =
    [
        'name'=>'Placeholder name',
        'email'=>'Placeholder email',
        'message'=>'Placeholder message'
    ];

(empty($_POST))
    ?   $validate = new FormValidatorClass(array())
    :   ($validate = new FormValidatorClass($_POST));

echo $validate->input['name']->value;
echo $validate->input['email']->value;
echo $validate->input['message']->value;

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
        .wrapper { display: table; margin: 0 auto; display: table; }
    </style>
</head>
    <body>
    <h1>'Contact me'</h1>
    <div class="wrapper">
        <form method="POST">
            <input type="text" name="name" placeholder=<?= '"'.$placeholder['name'].'"';?> >
            <input type="text" name="email" placeholder=<?= '"'.$placeholder['email'].'"';?> >
            <textarea name="message"><?= $placeholder['message'] ?></textarea>
            <input type="submit" >
        </form>
    </div>
    </body>
</html>