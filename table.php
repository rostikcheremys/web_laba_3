<?php

$filename = 'data/oblinfo.txt';

if (file_exists($filename)) {
    $file = fopen($filename, 'r');

    $data = [];

    while (($line = fgets($file)) !== false) {

        $line = trim($line);

        $data[] = $line;
    }

    fclose($file);

    echo "<table border='1' cellpadding='10' cellspacing='0'>" .
        "<tr><th>№</th><th>Область</th><th>Населення (тис.)</th><th>Кількість вищих навчальних закладів</th><th>Кількість вищих навчальних закладів на 100 тис. населення</th></tr>";

    $number = 0;

    for ($i = 0; $i < count($data); $i += 3) {

        $number++;
        $population = $data[$i + 1];
        $universities = $data[$i + 2];
        $universitiesPer100k = ($population != 0) ? round($universities * 100 / $population, 2) : 0;

        echo "<tr>" . implode('', [
                "<td>{$number}</td>",
                "<td>{$data[$i]}</td>",
                "<td>{$data[$i + 1]}</td>",
                "<td>{$data[$i + 2]}</td>",
                "<td>{$universitiesPer100k}</td>"
            ]) . "</tr>";
    }

    echo "</table>";
} else {
    echo "Файл не знайдено!";
}

