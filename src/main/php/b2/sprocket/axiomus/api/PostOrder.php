<?php


namespace b2\sprocket\axiomus\api;

/* Заявка на отправку Почтой России (методы new_post и update_post) */

class PostOrder extends OrderDefault
{
    use OrderInfoTrait;

    private $beginDate; // Carry
    private $postType;
    private $email; // Carry // New
    private $sms; // Carry // New
    private $smsInform;

    function getBeginDate()
    {
        return $this->beginDate;
    }

    function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;
        return $this;
    }

    function getPostType()
    {
        return $this->postType;
    }

    function setPostType($postType)
    {
        $this->postType = $postType;
        return $this;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    function getSms()
    {
        return $this->sms;
    }

    function setSms($sms)
    {
        $this->sms = $sms;
        return $this;
    }

    function getSmsInform()
    {
        return $this->smsInform;
    }

    function setSmsInform($smsInform)
    {
        $this->smsInform = $smsInform;
        return $this;
    }

}