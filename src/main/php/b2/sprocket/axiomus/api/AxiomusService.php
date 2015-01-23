<?php
/**
 * User: Inc
 * Date: 19.01.2015
 * Time: 17:11
 */

namespace b2\sprocket\axiomus\api;

use b2\task\TaskRef;

interface AxiomusService
{

    const ORDER_DELIVERY = 'delivery';
    const ORDER_CARRY = 'carry';
    const ORDER_POST = 'post';
    const ORDER_DPD = 'dpd';

    /**
     * Создает новую заявку с указанным типом $orderType.
     *
     * @param AppInfo $data
     * @param string $orderType
     * @param object $order
     * @param TaskRef $replyTo
     * @return void
     */
    function newOrder(AppInfo $data, $orderType, $order, TaskRef $replyTo);

    /**
     * Обновляет заявку с указанным типом $orderType.
     *
     * @param AppInfo $data
     * @param string $orderType
     * @param object $order
     * @param TaskRef $replyTo
     * @return void
     */
    function updateOrder(AppInfo $data, $orderType, $order, TaskRef $replyTo);

    /**
     * Запрос текущего статуса заявки (если $okey - строка) или заявок (если $okey - массив строк).
     *
     * @param string|array $okey один или несколько (массив) значений okey
     * @param TaskRef $replyTo
     * @return void
     */
    function getStatus($okey, TaskRef $replyTo);

}
