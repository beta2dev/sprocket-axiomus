<?php


namespace b2\sprocket\axiomus\gate;

use b2\sprocket\axiomus\api\AuthRequest;
use b2\sprocket\axiomus\api\SingleOrderRequest;
use b2\task\Task;
use b2\task\TaskRef;
use b2\sprocket\axiomus\api\AxiomusService;
use b2\sprocket\axiomus\api\AppInfo;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 * @MongoDB\DiscriminatorValue("b2\sprocket\axiomus\gate\AxiomusServiceTask")
 */


class AxiomusServiceTask extends Task implements AxiomusService
{
    /**
     * @MongoDB\reply
     */
    private $replyTo;

    function newOrder(AppInfo $data, $orderType, $order, TaskRef $replyTo)
    {
        $this->createSingleOrder($data, $orderType, 'new', $order, $replyTo);
    }

    function updateOrder(AppInfo $data, $orderType, $order, TaskRef $replyTo)
    {
        $this->createSingleOrder($data, $orderType, 'update', $order, $replyTo);
    }

    function getStatus($okey, TaskRef $replyTo)
    {
        $this->replyTo = $replyTo;
        $singleOrder = new SingleOrderRequest();
        $mode = '';
        if (is_string($okey)){
            $mode = 'status';
            $singleOrder->setOkey($okey);
        }
        else{
            $mode = 'status_list';
            $singleOrder->setOkeylist($okey);
        }
        $singleOrder->setMode($mode);
        $singleOrder = (new XmlMake())->makeXml($singleOrder);

        $ref = $this->getSelfObjectRef();

        $this->sendHttpRequest('POST', 'some-url', $singleOrder, $ref);

    }

    function run($response)
    {
        $payload = (new XmlGet())->responseMap($response);

        \b2\task::caller()->callTaskPayload($this->replyTo, $payload);
    }

    private function sendHttpRequest($method, $url, $body, TaskRef $replyTo)
    {
        // todo !!!
    }

    private function getCheckSum($uid, $order)
    {
        $numberOfItems = count($order->getOrderContent()->getItems());
        $totalItemsCount = 0;

        foreach ($order->getOrderContent()->getItems() as $v){
            $totalItemsCount += $v->getQuantity();
        }

        return md5($uid . 'u' . $numberOfItems . $totalItemsCount);
    }

    /**
     * @param AppInfo $data - содержит uid и ukey
     * @param string $orderType = new_carry || new_post || update_dpd etc...
     * @param string $orderStyle = 'new' or 'update'
     * @param array $order - содержит <order> с его параметрами и внутренностями
     * @param TaskRef $replyTo - кому отвечать
     * @return SimpleXML->asXML()
     */

    private function createSingleOrder(AppInfo $data, $orderType, $orderStyle, $order, TaskRef $replyTo)
    {
        $this->replyTo = $replyTo;

        $singleOrder = new SingleOrderRequest();

        $mode = $orderType == 'delivery' ? $orderStyle : $orderStyle . '_' . $orderType;
        $auth = (new AuthRequest())
            ->setUkey($data->getUkey())
            ->setCheckSum($this->getCheckSum($data->getUid(), $order));
        $singleOrder->setOrder($order)->setMode($mode)->setAuth($auth);
        $singleOrder = (new XmlMake())->makeXml($singleOrder);

        $ref = $this->getSelfObjectRef();

        $this->sendHttpRequest('POST', 'some-url', $singleOrder, $ref);
    }
}