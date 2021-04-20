<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach($newsList as $newsItem) { ?>
            <li>
                <a href="news/<?php echo $newsItem['id']?>"><?php echo $newsItem['title']?></a>
                <p><?php echo $newsItem['date']?></p>
                <p><?php echo $newsItem['short_content']?></p>
            </li>
        <?php } ?>
    </ul>
</body>
</html>