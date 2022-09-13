<?php

$i = 0;
foreach ($_GET as $key => $value) {
  $i++;
  echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value[0])."<br>";
}
if (!mkdir("../Storage/OC/M/Adam", 0777, true)) {
    die('Failed to create directories...');
}

echo $i;

?>