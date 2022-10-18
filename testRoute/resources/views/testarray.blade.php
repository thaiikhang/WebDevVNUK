<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head>
<body>

    <div class="loop__array">
        <h1>Loop Array</h1>
        <?php
            foreach ($student as $temp)
                foreach ($temp as $k => $v) {
                    echo '<p>'. $k. ':'. $v. '</p>';
                }
        ?>
    </div>
</body>
</html>