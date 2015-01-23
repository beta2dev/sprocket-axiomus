<?php


namespace b2\sprocket\axiomus\api;

/* Заявка на отправку DPD (методы new_dpd и update_dpd)  */

class DpdOrder extends OrderTimeScope
{
    use OrderInfoTrait;

    private $beginDate; // Carry // Post
    private $postType; // Post
    private $email;

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
    } // Carry // New // Post
}