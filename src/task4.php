<pre>
<?php
/**
 * Created by PhpStorm.
 * User: PCuser
 * Date: 26.08.2018
 * Time: 23:0
 */
function findValue($array1, $searchKey)
{

    foreach ($array1 as $key => $value) {
        if ($key === $searchKey) {
            return $value;
        } else {
            if (is_array($key) == true) {
                return findValue($key, $searchKey);
            }
        }
    }
}

function task4()
{
    $url = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";

    $content = file_get_contents($url);
    if (empty($content)) {
        echo 'Файл пустой!';
        return null;
    }

    $json = json_decode($content, true);

    $title = findValue($json, 'title');

    if (!empty($title)) {
        echo 'title = ' . $title . PHP_EOL;
    } else {
        echo 'Пусто! title нет' . PHP_EOL;
    }

    $pageid = findValue($json, 'pageid');
    if (!empty($pageid)) {
        echo 'pageid = ' . $pageid . PHP_EOL;
    } else {
        echo 'Пусто! pageid нет' . PHP_EOL;
    }


   // echo var_dump($json);
}

task4();
