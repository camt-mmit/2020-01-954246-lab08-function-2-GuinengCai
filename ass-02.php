<?php
/*ID: 612110237
Name: Guineng Cai 
*/
    $fp = fopen($_SERVER['argv'][1], "r");
    
    fscanf($fp, "%d", $n);
    $datas = [];
    for($i = 0; $i < $n; $i++) {
        $data = [];
        fscanf($fp, "%s %s %f %f",
            $data['name'], $data['section'],
            $data['1'], $data['2']);
        $datas[] = $data;
    }
    
    fclose($fp);

    $datas = array_map(function($data) {
        $data['total'] = $data['1'] + $data['2'];
        
        return $data;
    }, $datas);
    
    $avg = array_reduce($datas, function($carry, $data) {
        return $carry + $data['total'];
    }, 0)/count($datas);

    $sum = array_reduce($datas, function($carry, $data) use($avg) {
        if($data['total'] >= $avg) return $carry + $data['total'];
        return $carry;
    }, 0);

    array_walk($datas, function($data) {
        printf("%-10s %-3s: %6.2f %6.2f = %6.2f\n",
            $data['name'], $data['section'],
            $data['1'], $data['2'],
            $data['total']);
    });

    printf("\n");
    printf("Average total score : %6.2f\n", $avg);
    printf("Summation of total score greater than or equal %6.2f : %6.2f\n", $avg, $sum);
