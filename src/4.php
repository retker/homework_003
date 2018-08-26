<pre>
<?php

function find($arr, $key)
{
    //echo $key . PHP_EOL;
   // print_r($arr);
    foreach ($arr as $k => $v) {
        if ($k == $key) {
            return [$v]; // нашли - выходим из рекурсии
        } else {
            if (is_array($v)) {
                return find($v, $key);
            }
        }
    }
    echo 'не удалось найти' . PHP_EOL;
    return null; // не нашли
}

function task40()
{
    $link = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";
    $json = file_get_contents($link);

    $data = json_decode($json, true);

    $title = find($data, "title");
    echo 'title = ' . $title . PHP_EOL;

    $pageid = find($data, "pageid");
    echo 'pageid = ' . $pageid . PHP_EOL;
}

task40();