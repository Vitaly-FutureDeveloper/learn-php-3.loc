<?php
// Описание функции Web-сервиса
  function getStock($id=null) {	
    $stock = array(
			"1" => 100,
			"2" => 200,
			"3" => 300,
			"4" => 400,
			"5" => 500
    );
    if ( $id !== null ) {
      $quantity = $stock[$id];		
      return serialize($quantity);
    } else{
      return serialize($stock);
    }/*
    else {
      throw new SoapFault("Server", "Несуществующий id товара");
    }	*/
  }
// Отключение кэширования WSDL-документа
ini_set("soap.wsdl_cache_enabled", "0");
// Создание SOAP-сервер
$server = new SoapServer("http://learn-php-3.loc//demo/soap/stock.wsdl");
// Добавить класс к серверу
$server->addFunction("getStock");
// Запуск сервера
$server->handle();
?>