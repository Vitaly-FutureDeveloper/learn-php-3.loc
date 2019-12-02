<?php

$client = new SoapClient("http://learn-php-3.loc/soap/news.wsdl");

try {
    $result = $client->getNewsCount();
        echo "<p>Всего новостей: $result</p>";

    $result = $client->getNewsCountByCat(1);
        echo "<p>Всего новостей in politics: $result</p>";

    $result = $client->getNewsById(1);
        echo "<pre>";
            var_dump( unserialize(base64_decode($result)) );
        echo "</pre>";
}catch(SoapFault $e) {
    echo 'Operation ' . $e->faultcode . ' returned error: ' . $e->getMessage();
}