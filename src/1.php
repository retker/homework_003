<pre>
<?php

function task4($url, $params)
{
    $content = file_get_contents($url);
    if (empty($content)) {
        return null;
    }
    $json = json_decode($content, true);
    if (empty($json["query"]["pages"])) {
        return null;
    }

    // 2. Вывести title и page_id
    $result = array_shift($json["query"]["pages"]);
    foreach ($params as $value) {
        echo "<br>", $value . " = " . $result[$value];
    }
}

$url = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";
$params = ["title", "pageid"];

echo  task4($url, $params);


