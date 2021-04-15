<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    +css('reset')
    <title><?= $GLOBALS['lang']['error'] . (!is_null($code) ? " {$code}" : '') ?></title>
</head>
<body>

+include('header')

<div>
    <p><?= $GLOBALS['lang']['error'] . ': ' . (!is_null($code) ? "{$code} | " : '') . htmlspecialchars($message) ?></p>
</div>

+include('footer')
</body>
</html>
