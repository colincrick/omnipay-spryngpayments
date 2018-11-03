<?php

namespace Omnipay\SpryngPayments\Methods;

use Omnipay\SpryngPayments\PaymentMethod;

class Klarna implements PaymentMethod
{

    /**
     * Get the required parameters to make a purchase with this payment method
     *
     * @return array
     */
    public static function requiredPurchaseParameters()
    {
        return [
            'account',
            'amount',
            'capture',
            'customerIp',
            'customer',
            'goodsList',
            'dynamicDescriptor',
            'merchantReference',
            'pclass',
            'returnUrl',
            'userAgent'
        ];
    }

    /**
     * Get the URL to initiate a transaction with this payment method.
     *
     * @return string
     */
    public static function getInitiateUrl()
    {
        return '/transaction/klarna/initiate';
    }

    /**
     * Takes the default data for a purchase request and makes method-specific changes
     *
     * @param $data
     * @param $parameters
     * @return mixed
     */
    public function setPurchaseData($data, $parameters)
    {
        $data['details']['goods_list']  = $parameters['goods_list'];
        $data['details']['pclass']      = $parameters['pclass'];

        return $data;
    }

    /**
     * Get the URL to refund a transaction
     *
     * @param $transactionReference
     * @return mixed
     */
    public static function getRefundUrl($transactionReference)
    {
        return '/transaction/'.$transactionReference.'/klarna/klarna/refund';
    }

    /**
     * Get the required parameters to complete a refund with this method
     *
     * @return array
     */
    public static function requiredRefundParameters()
    {
        return [
            'goodsList',
            'reason'
        ];
    }

    /**
     * Takes the default data for a refund request and makes method-specific changes
     *
     * @param $data
     * @param $parameters
     * @return mixed
     */
    public function setRefundData($data, $parameters)
    {
        $data['details']['goods_list'] = $parameters['goodsList'];
        $data['reason'] = $parameters['reason'];

        return $data;
    }
}