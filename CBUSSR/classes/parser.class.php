<?php

require_once "intcbo.class.php";

class parser implements intcbo {

    const FILE_XML = "XML_daily.asp";
    const XML_URL = "http://www.cbr.ru/scripts/XML_daily.asp";
    public $sxml;

    function __construct() {
        $this->checkXMLfile();
        $this->sxml = simplexml_load_file(self::FILE_XML);
    }

    function checkXMLfile() { //проверка на актуальность
        $time = time();
        $filetime = '';

        if( !file_exists(self::FILE_XML) ){
            copy(self::XML_URL, self::FILE_XML);
            sleep(1);
        }

        $filetime = filemtime(self::FILE_XML) + 10000;
        if( $time > $filetime ) {
            unlink(self::FILE_XML);
                sleep(1);
            copy(self::XML_URL, self::FILE_XML);
                sleep(1);
        }
    }

    function selector(){ //формирует выбор 1 валюты для запроса на сервер
        foreach ($this->sxml->Valute as $items){ ?>
            <option value="<?= $items->NumCode ?>"><?= $items->Name ?></option>
            <?
        }
    }

    function cycleOne($idval) { //Выцепить 1 запись по ID
        foreach ($this->sxml->Valute as $items) {
            if($items->NumCode != $idval)
                continue;
            else { ?>
                <tr class="Valutes"> 
                    <td class="ValuteID"><?= $items['ID']?></td>
                    <td class="NumCode"><?= $items->NumCode?></td>
                    <td class="CharCode"><?= $items->CharCode?></td>
                    <td class="Nominal"><?= $items->Nominal?></td>
                    <td class="Name"><?= $items->Name?></td>
                    <td class="Value"><?= $items->Value?></td>
                </tr>
                <?
                break;
            }
        }
    }

    function cycleAll() {  //Выцепить все записи
        foreach($this->sxml->Valute as $items) { ?>
            <tr class="Valutes"> 
                <td class="ValuteID"><?= $items['ID']?></td>
                <td class="NumCode">ISO <?= $items->NumCode?></td>
                <td class="CharCode"><?= $items->CharCode?></td>
                <td class="Nominal"><?= $items->Nominal?></td>
                <td class="Name"><?= $items->Name?></td>
                <td class="Value"><?= $items->Value?> Руб.</td>
            </tr>
    <?
        }
    }
}