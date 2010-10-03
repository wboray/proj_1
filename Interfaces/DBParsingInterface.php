<?php
/**
 * DBParsingInterface
 * 
 * Интерфейс для парсинга поисковых систем
 */
interface DBParsingInterface{
    /**
     * Получение из базы webexpert_acc случайного свободного ip
     * @return string
     */
    function getip();
    /**
     * Получает массив ключевиков
     *@param int $count сколько хотим получить ключевиков
     *@return array Keyword массив из keyword
     */
    function getKeywords($count = 30);
    /**
     * Добавить данные в таблицу Seocomp
     * @param Keyword $k
     * @param string $seoH
     */
    function addSeoComp($k, $seoH);
    /**
     * проставить значения "1"(пропарсено) для ключевиков из списка $listIdkeyword
     */
    function updateKeywords();
    /**
     * Добавить данные в таблицу Seo
     */
    function updateSeo();

}
?>
