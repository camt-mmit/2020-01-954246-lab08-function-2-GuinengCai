<?php
/*ID: 612110237
Name: Guineng Cai 
*/
    $fp = fopen($_SERVER['argv'][1], 'r');

    fscanf($fp, "%d", $n);
    $items = [];
    for($i = 0; $i < $n; $i++) {
        $item = [];
        fscanf($fp, "%s %f", $item['name'], $item['score']);
        $items[] = $item;
    }

    fclose($fp);

    $avg = array_reduce($items, function($carry, $item) {
        return $carry + $item['score'];
    }, 0) / count($items);

    $passes = array_filter($items, function($item) use ($avg) {
        return $item['score'] >= $avg;
    });

    $fails = array_filter($items, function($item) use ($avg) {
        return $item['score'] < $avg;
    });

    $printScore = function($item) {
        printf("%10s: %6.2f\n", $item['name'], $item['score']);
    };

    printf("Average score is %8.4f\n", $avg);
    printf("Number of students who pass average is %4d:\n", count($passes));
    array_walk($passes, $printScore);
    printf("Number of students who fail average is %4d:\n", count($fails));
    array_walk($fails, $printScore);
