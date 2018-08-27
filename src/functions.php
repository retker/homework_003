<?php

function task1()
{
    $pathXml = 'data.xml';
    $file = file_get_contents($pathXml);
    $xml = new SimpleXMLElement($file);

    echo $xml->attributes()->getName() . ':' . PHP_EOL;
    echo $xml->attributes()->PurchaseOrderNumber . PHP_EOL;
    echo date('d.m.Y', Strtotime($xml->attributes()->OrderDate));
    echo PHP_EOL . PHP_EOL;

    foreach ($xml->Address as $items) {
        foreach ($items->attributes() as $types) {
            echo $types . ': ' . PHP_EOL;
            foreach ($items as $item => $val) {
                echo $item . ': ' . $val . PHP_EOL;
            }
            echo PHP_EOL;
        }
    }
    echo PHP_EOL;

    echo $xml->DeliveryNotes->getName() . ': ';
    echo $xml->DeliveryNotes . PHP_EOL;
    echo PHP_EOL;

    foreach ($xml->Items as $key) {
        echo $key->getName() . ':' . PHP_EOL;
        foreach ($key as $k) {
            echo $k->attributes()->getName() . ':' . $k->attributes() . PHP_EOL;
            foreach ($k as $item => $itemK) {
                if ($item == 'ShipDate') {
                    $itemK = date('d.m.Y', Strtotime($itemK));
                }
                echo $item . ': ' . $itemK . ' ' . PHP_EOL;
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }
}

function task2()
{
    $list = array(
        array('Pentium G', 'Cori_i3', 'Cori_i5', 'Cori_i7', 'Core_i9'),
        array('1150', '1151', '1151_v2', '1156', '2011'),
        array('Ti1050', 'Ti1060', 'Ti1070', 'Ti1080', 'Ti1090')
    );

    $jsonMain = json_encode($list);
    file_put_contents('output.json', $jsonMain);

    $jsonContent1 = file_get_contents('output.json');
    $decodedJson1 = json_decode($jsonContent1, true);
    echo 'Данные успешно записаны в output.json' . PHP_EOL;

    $dzhoker = rand(0, 3);

    if ($dzhoker % 2 == 0) {
        $list [0][$dzhoker] = 'dzhoker';
        $list [1][$dzhoker + 1] = 'dzhoker';
        $list [2][$dzhoker + 2] = 'dzhoker';
    } else {
        $flag = false;
    }

    $jsonSlave = json_encode($list);
    file_put_contents('output2.json', $jsonSlave);
    echo 'Данные успешно записаны в output2.json' . PHP_EOL;

    if ($flag == false) {
        echo 'Измененных элементов нет.' . PHP_EOL;
    }


    //открываем только output2.json, output.json открыт выше.
    $jsonContent2 = file_get_contents('output2.json');
    $decodedJson2 = json_decode($jsonContent2, true);

    for ($i = 0; $i < count($decodedJson1); $i++) {
        for ($j = 0; $j < count($decodedJson1); $j++) {
            if ($decodedJson1 [$i][$j] != $decodedJson2 [$i][$j]) {
                echo 'Элемент из файла output.json ' . $decodedJson1 [$i][$j] .
                    ' был изменен на ' . $decodedJson2 [$i][$j] .
                    ' и записан в файл  output2.json ' . PHP_EOL;
            }
        }
    }
}

function task3()
{
    $result = 0;
    $numbers = [];
    $puth = 'file.csv';
    for ($i = 0; $i < 50; $i++) {
        $numbers[$i] = rand(1, 100);
    }

    $fcsv = fopen($puth, 'w');
    fputcsv($fcsv, $numbers, ';', '"');
    fclose($fcsv);
    echo 'Файл успешно записан!' . PHP_EOL;

    if (($fcsv = fopen($puth, "r")) !== false) {
        if (($data = fgetcsv($fcsv, 150, ";")) !== false) {
            $num = count($data);
            for ($i = 0; $i < $num; $i++) {
                if ($data[$i] % 2 == 0) {
                    $result += $data[$i];
                }
            }
        } else {
            echo 'Ошибка! Не удалось прочитать корректно данные из файла.';
        }
    } else {
        echo 'Ошибка! Не удалось открыть файл для чтения.';
    }

    fclose($fcsv);
    echo 'Сумма четных чисел = ' . $result . PHP_EOL;
}

function task4()
{
    $url1 = "https://en.wikipedia.org/w/";
    $url2 = "api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";
    $url = $url1 . $url2;
    $params = ["title", "pageid"];

    $content = file_get_contents($url);

    if (empty($content)) {
        return null;
    }

    $json = json_decode($content, true);

    if (empty($json["query"]["pages"])) {
        return null;
    }

    $result = array_shift($json["query"]["pages"]);
    foreach ($params as $value) {
        echo $value . " = " . $result[$value] . PHP_EOL;
    }
}
