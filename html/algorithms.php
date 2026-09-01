<?php

function mergeSort(array $arr, string $key, bool $desc = false): array {
    $n = count($arr);
    if ($n <= 1) {
        return $arr; 
    }
    $mid = intdiv($n, 2);
    $left  = mergeSort(array_slice($arr, 0, $mid), $key, $desc);
    $right = mergeSort(array_slice($arr, $mid), $key, $desc);
    return mergeArrays($left, $right, $key, $desc);
}

function mergeArrays(array $left, array $right, string $key, bool $desc): array {
    $result = [];
    $i = 0;
    $j = 0;
    while ($i < count($left) && $j < count($right)) {
        $lv = (float) $left[$i][$key];
        $rv = (float) $right[$j][$key];
        $takeLeft = $desc ? ($lv >= $rv) : ($lv <= $rv);
        if ($takeLeft) {
            $result[] = $left[$i];
            $i++;
        } else {
            $result[] = $right[$j];
            $j++;
        }
    } 
    while ($i < count($left))  { $result[] = $left[$i++]; }
    while ($j < count($right)) { $result[] = $right[$j++]; }
    return $result;
}
//Quick sort with O(n logn) efficiency
function quickSort(array $arr, string $key, bool $desc = false): array {
    $n = count($arr);
    if ($n <= 1) {
        return $arr;
    }
    $pivotIndex = intdiv($n, 2);
    $pivot = (float) $arr[$pivotIndex][$key];
    $less    = [];
    $equal   = [];
    $greater = [];
    foreach ($arr as $row) {
        $v = (float) $row[$key];
        if ($v < $pivot)      { $less[] = $row; }
        elseif ($v > $pivot)  { $greater[] = $row; }
        else                  { $equal[] = $row; }
    }
    $sortedLess    = quickSort($less, $key, $desc);
    $sortedGreater = quickSort($greater, $key, $desc);
    return $desc
        ? array_merge($sortedGreater, $equal, $sortedLess)
        : array_merge($sortedLess, $equal, $sortedGreater);
}
//Binary search algorithm iterative with O(log n) efficiency
function binarySearch(array $sortedArr, $target): bool {
    $low  = 0;
    $high = count($sortedArr) - 1;
    $target = (string) $target;
    while ($low <= $high) {
        $mid = intdiv($low + $high, 2);
        $midVal = (string) $sortedArr[$mid];
        if ($midVal === $target) {
            return true;
        } elseif ($midVal < $target) {
            $low = $mid + 1;   
        } else {
            $high = $mid - 1;  
        }
    }
    return false;
}

function sortSeatList(array $seats): array {
    $wrapped = array_map(function ($s) {
        return ['seat' => (float) $s, 'orig' => (string) $s];
    }, $seats);
    $sorted = mergeSort($wrapped, 'seat', false);
    return array_map(function ($row) {
        return $row['orig'];
    }, $sorted);
}
