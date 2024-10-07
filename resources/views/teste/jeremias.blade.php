<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeremias</title>
</head>
<body>

    <?php echo 'oi Jeremias'; ?>

    <?php foreach(range(1,20) as $key):?>

        <li><?= $key; ?></li>

    <?php endforeach; ?>

    @auth

        <span>  você está autenticado </span>

    @endauth

    @foreach(range(1,20) as $key)

        <li> {{ $key }} </li>

    @endforeach


</body>
</html>
