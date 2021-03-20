<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $_ENV['TEMPLATES'] ?>css/general.css" />
    <link rel="stylesheet" href="<?= $_ENV['TEMPLATES'] ?>css/reset.css" />
    <?php if (file_exists("{$_ENV['TEMPLATES']}css/{$page}.css")) echo "<link rel=\"stylesheet\" href=\"{$_ENV['TEMPLATES']}css/{$page}.css\" />"; ?>
    <title><?= $_ENV['APP_NAME'] ?></title>
</head>
<body>
    <header>
    </header>
    <main><?php var_dump(scandir('./')) ?>