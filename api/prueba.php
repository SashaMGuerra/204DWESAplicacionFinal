<?php
$content = file_get_contents("https://api.github.com/users/zellwk/repos");

var_dump($content);