<?php
/* 
 * IFormat
 *
 * класс формирующий вывод текста
 */

class IFormat {

    /**
     * Форматирует число в
     * @param float $value число, предполагается, что это секунды
     * @param int $fNumber Количество цифр после запятой
     * @param string $timing В каком виде 's' - секунды, 'ms' - милисекунды
     */
    public static function timer($value, $fNumber = 2, $timing = 's') {
        $result = '';
        $added = '';
        if ($timing == 's') {
            $result = sprintf('%01.' . $fNumber . 'f', $value);
            $added = 'sec';
        } elseif($timing == 'ms') {
            $result = sprintf('%01.' . $fNumber . 'f', $value);
            $added = 'ms';
        }
        return $result . ' ' . $added;
    }
}
?>
