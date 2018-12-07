<?php

namespace Omnipay\SpryngPayments\Message\Response;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCheckoutResponse extends AbstractSpryngPaymentsResponse implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isRedirect()
    {
        return isset($this->data['url']);
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->data['url'];
    }

}