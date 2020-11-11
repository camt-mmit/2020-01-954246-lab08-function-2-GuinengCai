<?php
/*ID: 612110237
Name: Guineng Cai 
*/
    $fp = fopen($_SERVER['argv'][1], "r");

    $field = $_SERVER['argv'][2];

    $field = strtolower($field);

    $section = ($_SERVER['argc'] === 4)? $_SERVER['argv'][3] : null;

    

    fscanf($fp, "%d", $n);

    $datas = [];

    for($i = 0; $i < $n; $i++) {

        $data = [];

        fscanf($fp, "%s %s %f %f %f", $data['name'], $data['section'],

            $data['1'], $data['2'], $data['3']);

        $datas[] = $data;

    }

    

    fclose($fp);

    

    $datas = array_filter($datas, function($data) use ($section) {

        return ($section === null) || ($data['section'] === $section);

    });

    

    $datas = array_map(function($data) {

        $data['total'] = $data['1'] + $data['2'] + $data['3'];

        

        return $data;

    }, $datas);

    

    $comp = function ($pre, $next) {

            if($pre < $next) return -1;

            if($pre > $next) return  1;

            return 0;

    };

    

    usort($datas, function($pre, $next) use ($field, $comp) {

        if(($result = $comp($pre[$field], $next[$field])) !== 0) return $result;

        

        if("name" === $field) {

            return $comp($pre['section'], $next['section']);

        } else {

            if(($result = $comp($pre['section'], $next['section'])) !== 0) return $result;

            return $comp($pre['name'], $next['name']);

        }

    });

    

    $num = count($datas);

    $avg = array_reduce($datas, function($carry, $data) use ($num) {

        return $carry + ($data['total'] / $num);

    }, 0);

    

    array_walk($datas, function($data) {

        printf("%-10s %3s: %6.2f %6.2f %6.2f = %6.2f\n",

            $data['name'], $data['section'],

            $data['1'], $data['2'], $data['3'],

            $data['total']

        );

    });

    

    printf("\nAverage total score = %6.2f\n", $avg);

