<?php
if ( is_numeric($id) ) {
    $result = $news->deleteNews($id);
}
else {
    //$errMsg = "Ошибка при удалении новости";
    header("Location: http://learn-php-3.loc/news/news.php");
}

if ($result) {
    header("Location: http://learn-php-3.loc/news/news.php");
}
else{
    $errMsg = "Ошибка при удалении новости";
}