<?php
try {
  // Создание SOAP-клиента
  $client = new SoapClient("http://learn-php-3.loc//demo/soap/stock.wsdl");
	
  // Посылка SOAP-запроса c получением результат
  $result = $client->getStock("2");
  echo "Текущий запас на складе: ", var_dump(unserialize($result));
} catch (SoapFault $exception) {
  echo $exception->getMessage();	
}
?>