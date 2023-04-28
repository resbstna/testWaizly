<?php
// test 1
$arr = [1, 3, 5, 7, 9];
miniMaxSum($arr);

function miniMaxSum($arr)
{
    // sort array asc order
    sort($arr);

    $min_sum = $arr[0] + $arr[1] + $arr[2] + $arr[3];
    $max_sum = $arr[1] + $arr[2] + $arr[3] + $arr[4];

    echo $min_sum . " " . $max_sum;
}

// test 2
$arr = [1, 1, 0, -1, -1];
plusMinus($arr);

function plusMinus($arr)
{
    $positive = 0;
    $negative = 0;
    $zero = 0;
    // perulangan dari array
    foreach ($arr as $num) {
        //jika data array postif maka menambahkan dengan positif yang lain
        if ($num > 0) {
            $positive++;
            //jika data array negatif maka menambahkan dengan negatif yang lain
        } else if ($num < 0) {
            $negative++;
        } else {
            //jika tidak keduanya maka akan mendapatkan angka 0
            $zero++;
        }
    }

    printf("%.6f\n", $positive / count($arr));
    printf("%.6f\n", $negative / count($arr));
    printf("%.6f\n", $zero / count($arr));
}

// test 3

$s = '12:01:00PM';
timeConversion($s);
function timeConversion($s) {
    $hours = substr($s, 0, 2); // mendapatkan jam 12
    $minutes = substr($s, 3, 2); // mendapatkan minutes 01
    $seconds = substr($s, 6, 2);// mendapatkan detik
    $ampm = substr($s, 8, 2); // untuk mendapatkan pm

    if ($ampm == "PM" ) {
        $hours = 12;
    }
    if ($ampm == "AM") {
        $hours = 0;
    }

    echo sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
}
