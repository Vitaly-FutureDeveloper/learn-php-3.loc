<?php
if( !$posts = $news->getNews() ) {
    $errMsg = "Ошибка при выборе новостной ленты";
}
else {
    echo "<p>Всего записей: " . count($posts) . "</p>";
    foreach($posts as $items) {
        echo "<h3><a href='" . $_SERVER['PHP_SELF'] . "?id=" . $items['id'] . "'>{$items['title']}</a></h3>";
        echo "<p>{$items['category']}</p>";
        echo "<p>{$items['description']}";
        echo "<br>{$items['source']}";
        echo "<br><b>Добавлено: " . date('Y-m-d | H:i:s ', $items['datetime']) . " ";
        echo "<u><a href='/news/news.php?id={$items['id']}'>Удалить</a> </u></b></p>";
    }
}