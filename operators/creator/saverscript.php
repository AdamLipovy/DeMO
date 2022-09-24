<?php

function getElementByClassname ($html, $classname) {
  $dom = new DOMDocument();
  $dom->loadHTML($html);

  $xpath = new DOMXpath($dom);
  $nodes = $xpath->query('//div[@class="' . $classname . '"]');

  $tmp_dom = new DOMDocument();
  foreach ($nodes as $node) {
    $tmp_dom->appendChild($tmp_dom->importNode($node, true));
  }

  return trim($tmp_dom->saveHTML());
}
?>