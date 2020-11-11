<?php
/*ID: 612110237
Name: Guineng Cai 
*/
    $fp = fopen($_SERVER['argv'][1], "r");

    

    fscanf($fp, "%d", $n);

    $datas = [];

    for($i = 0; $i < $n; $i++) {

        $data = [];

        fscanf($fp, "%s %s %f", $data['name'], $data['section'], $data['score']);

        $datas[] = $data;

    }

    

    fclose($fp);

    

    usort($datas, function($pre, $next) {

        if($pre['score'] < $next['score']) return  1;

        if($pre['score'] > $next['score']) return -1;

        return 0;

    });

    

    array_walk($datas, function($data) {

        printf("%-10s %-3s: %6.2f\n", $data['name'], $data['section'], $data['score']);

    });

