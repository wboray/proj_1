<?php
/**
 * GetInfoInterface
 *
 * Интерфейс для любого класса, который хочет поддерживать вывод информации о себе
 */
interface GetInfoInterface{
    /**
     * Получение из базы webexpert_acc случайного свободного ip
     * @return string
     */
    public function GetInfo();
}
?>
