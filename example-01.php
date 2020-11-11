<?php
/*ID: 612110237
Name: Guineng Cai 
*/
    $fp = fopen($_SERVER['argv'][1], 'r');

    fscanf($fp, "%d", $n);
    $students = [];
    for($i = 0; $i < $n; $i++) {
        $student = [];
        fscanf($fp, "%s %f", $student['name'], $student['score']);
        $students[] = $student;
    }

    fclose($fp);

    $avg = array_reduce($students, function($carry, $student) {
        return $carry + $student['score'];
    }, 0) / count($students);

    $passes = array_filter($students, function($student) use ($avg) {
        return $student['score'] >= $avg;
    });

    $fails = array_filter($students, function($student) use ($avg) {
        return $student['score'] < $avg;
    });

    $printStudent = function($student) {
        printf("%10s: %6.2f\n", $student['name'], $student['score']);
    };

    printf("Average score is %8.4f.\n", $avg);
    printf("Number of students who pass average is %3d :\n", count($passes));
    array_walk($passes, $printStudent);
    printf("Number of students who fail average is %3d :\n", count($fails));
    array_walk($fails, $printStudent);
