<?php

$dom = new DOMDocument("1.0", "utf-8");
$rss = $dom->createElement("rss");
$dom->appendChild("rss");

$dom->load("catalog.xml");

$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;

var_dump($root = $dom->documentElement);
