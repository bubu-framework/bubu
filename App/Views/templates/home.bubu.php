<?php

use Bubu\Utils\Form\FormTemplate;

$a = '<code>df</code>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    +css('reset')
    <title><?= $_ENV['APP_NAME'] ?></title>
</head>
<body>

+include('header')
+||a||
+|!a!|
<main>
    <p>
        Hello
    </p>
</main>
<?php
    echo FormTemplate::login('/login', 'POST');
?>
+include('footer')

</body>
</html>