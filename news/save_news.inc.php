<?php

$title = $news->clearStr($_POST["title"]); //- заголовок новости
$category = $news->clearStr($_POST["category"]); //- категория новости
$description = $news->clearStr($_POST["description"]); //- текст новости
$source = $news->clearStr($_POST["source"]); //- источник новости

if(empty($title) or empty($description)) {
    $errMsg = "Заполните все поля формы";
}
else {
    if( !$news->saveNews($title, $category, $description, $source) )
        $errMsg = "Ошибка при добавлении новости";
    else{
        header("Location: news.php");
        exit;
        }
}