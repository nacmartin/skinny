<?php

include(dirname(__FILE__).'/../bootstrap/Doctrine.php');
 
$t = new lime_test(1);

$t->comment('->getContentHtlm()');
$item = new SkinnyItem();
$item->text = 'Ahoy';
$t->is(substr($item->content_html, 0, 11), '<p>Ahoy</p>', '->getContentHtml() returns the html version of the content (Markdown)');
