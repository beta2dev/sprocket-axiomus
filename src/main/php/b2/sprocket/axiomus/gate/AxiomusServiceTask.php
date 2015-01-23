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
        $singleOrder = new SingleOrderRequest();

        $mode = $orderType == 'delivery' ? 'new' : 'new_' . $orderType;
        $auth = (new AuthRequest())
            ->setUkey($data->getUkey())
            ->setCheckSum($this->getCheckSum($data->getUid(), $order));
        $singleOrder->setOrder($order)->setMode($mode)->setAuth($auth);
        $singleOrder = (new XmlMake)->makeXml($singleOrder);

        $ref = $this->getSelfObjectRef();

        $this->sendHttpRequest('POST', 'some-url', $singleOrder, $ref);
        // todo дописать здесь ответ от сервака на $replyTo
        // \b2\task::createClientServiceProxy($replyTo->getAddress(), $replyTo->getClass());
    }

    function updateOrder(AppInfo $data, $orderType, $order, TaskRef $replyTo)
    {
        $singleOrder = new SingleOrderRequest();

        $mode = $orderType == 'delivery' ? 'update' : 'update_' . $orderType;
        $auth = (new AuthRequest())
            ->setUkey($data->getUkey())
            ->setCheckSum($this->getCheckSum($data->getUid(), $order));
        $singleOrder->setOrder($order)->setMode($mode)->setAuth($auth);
        $singleOrder = (new XmlMake())->makeXml($singleOrder);

        $ref = $this->getSelfObjectRef();

        $response = $this->sendHttpRequest('POST', 'some-url', $singleOrder, $ref);

        // todo дописать здесь ответ от сервака на $replyTo
        // \b2\task::createClientServiceProxy($replyTo->getAddress(), $replyTo->getClass());
    }

    function getStatus($okey, TaskRef $replyTo)
    {
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

        // todo дописать здесь ответ от сервака на $replyTo
        // \b2\task::createClientServiceProxy($replyTo->getAddress(), $replyTo->getClass());
    }

    private function sendHttpRequest($method, $url, $body, TaskRef $replyTo)
    {
        /*// todo !!!
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($body));
        //$result = curl_exec($ch);
        curl_close($ch);

        \b2\task::createClientServiceProxy($replyTo->getAddress(), $replyTo->getClass());*/
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
}