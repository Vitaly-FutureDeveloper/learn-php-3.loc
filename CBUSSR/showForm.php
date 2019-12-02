<?php
function __autoload($nameclass) {
    require_once "classes/$nameclass.class.php";
}

$parser = new parser();
$parser->checkXMLfile();

?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>CB-USSR</title>
</head>
<body>
    <header class="header">
        <h1>Курс валют центробанка</h1>
    </header>

    <main>
        <section class="for_form">
            <form method="POST" class="querygen" action="<?= $_SERVER['PHP_SELF']?>">
                <fieldset><legend>Запрос курса валют</legend>
                <fieldset>
                    <label><p>Валюта относительно Рубля</p>
                    <select name="valutes" id="valutes">
                        <option value="all">Вывести все</option>
                        <?php
                            $parser->selector(); //формирует выбор 1 валюты для запроса на сервер
                        ?>
                    </select></label>
                </fieldset>
                <button type="submit" name="button" value="simple">Отобразить</button>
                </fieldset>
            </form>
        </section>
        <section class="for_rez">
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['button'] == 'simple') { ?>
            <table class="table">
                <tr class="Valutes"> 
                    <th>ID</th>
                    <th>Код валюты</th>
                    <th>Обозначение</th>
                    <th>Номинал</th>
                    <th>Название</th>
                    <th>Стоимость</th>
                </tr> 
                <?php
                        $idval = $_POST['valutes'];

                        if($idval == 'all')
                            $parser->cycleAll(); //Отображение всего
                        else
                            $parser->cycleOne($idval);
            }
                ?>
            </table>

        </section>
    </main>
</body>
</html>