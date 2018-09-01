<?php

/**
 * Returns an array of letters and numbers with the option to also include lower-case alphabet characters.
 * @param bool|true $caseSensitive
 * @return array
 */
function get_alphabet(bool $caseSensitive = true): array
{
    if ($caseSensitive) {
        return array_merge(
            range('a', 'z'),
            range('A', 'Z'),
            range(0, 9)
        );
    }

    return array_merge(range('A', 'Z'), range(0, 9));
}


/**
 * bijective_encode function
 *
 * @param int $number
 * @param bool $caseSensitive
 * @return string
 */
function bijective_encode(int $number, bool $caseSensitive = true): string
{
    $alphabet = get_alphabet($caseSensitive);

    if ($number == 0) {
        return $alphabet[$number];
    }

    $result = '';
    $base = count($alphabet);

    while ($number > 0) {
        $digit = $number % $base;
        $result = $alphabet[$digit] . $result;
        $number = floor($number / $base);
    }

    return $result;
}

/**
 * bijective_decode function
 *
 * @param string $code
 * @param bool $caseSensitive
 * @return int
 */
function bijective_decode(string $code, bool $caseSensitive = true): int
{
    if ($code == '') {
        return null;
    }

    $alphabet = get_alphabet($caseSensitive);
    $base = count($alphabet);
    $table = array_flip($alphabet);
    $code = str_split($code);
    $length = count($code);
    $result = 0;

    for ($i = 0; $i < $length; ++$i) {
        if (!isset($table[$code[$i]])) {
            return null;
        }

        $result += ($table[$code[$i]] * pow($base, $length - $i - 1));
    }

    return $result;
}

/**
 * check if string start with the given prefix
 *
 * @param string $string
 * @param string $prefix
 * @return bool
 */
function str_start_with(string $string, string $prefix): bool
{
    return substr($string, 0, strlen($prefix)) === $prefix;
}
