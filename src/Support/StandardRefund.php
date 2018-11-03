<?php

namespace Omnipay\SpryngPayments\Support;

trait StandardRefund
{
    /**
     * Get the required parameters to complete a refund with this method
     *
     * @return array
     */
    public static function requiredRefundParameters()
    {
        return [
            'amount',
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
        $data['amount'] = $parameters['amount'];
        $data['reason'] = $parameters['reason'];

        return $data;
    }
}