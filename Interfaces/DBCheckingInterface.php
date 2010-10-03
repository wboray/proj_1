<?php
/**
 * DBCheckingInterface
 *
 * Интерфейс для проверки наличия Апдейта
 */

interface DBCheckingInterface{
    /**
     * узнает состояние по апдейтам на сегодня
     */
    function isUpdate();
    /**
     * устаналивает отметку о том, был ли апдейт
     * @param bool $value
     * @return int count affected rows
     */
    function updateSEUpdates($value);
    /**
     * !need refactoring!
     * Ставит всем ключевикам "2", т.е. что они все пропарсены
     * @return int count affected rows
     */
    function checkKeywords();
    /**
     * Получает количество не пропарсенных ключевиков
     * @return int
     */
    function getParsingKeywords();
    /**
     * Получает время полседнего апдейта
     * @return int
     */
    function timeLastUpdate();

    function addUpdSeocomp();
    /**
     * получает список всех наших ключевиков с номерами позиций
     * @param int $time За какое число
     */
    function getSeoList($time);

    /**
     * Очищает, собранные за сегодня, данные
     */
    function clearDataToday();
}
?>
