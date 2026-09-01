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