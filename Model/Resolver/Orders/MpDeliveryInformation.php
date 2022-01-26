<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_DeliveryTimeGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\DeliveryTimeGraphQl\Model\Resolver\Orders;

use Exception;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Sales\Model\OrderFactory;
use Mageplaza\DeliveryTime\Helper\Data;

/**
 * Class MpDeliveryInformation
 * @package Mageplaza\DeliveryTimeGraphQl\Model\Resolver\Orders
 */
class MpDeliveryInformation implements ResolverInterface
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * MpReward constructor.
     *
     * @param Data $helperData
     * @param OrderFactory $orderFactory
     */
    public function __construct(
        Data $helperData,
        OrderFactory $orderFactory
    ) {
        $this->helperData   = $helperData;
        $this->orderFactory = $orderFactory;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->helperData->isEnabled()) {
            return [];
        }

        try {
            if (isset($value['increment_id'])) {
                $order                 = $this->orderFactory->create()->loadByIncrementId($value['increment_id']);
                $mpDeliveryInformation = Data::jsonDecode($order->getData($field->getName()));

                return [
                    'mp_delivery_date'       => isset($mpDeliveryInformation['deliveryDate'])
                        ? $mpDeliveryInformation['deliveryDate'] : null,
                    'mp_delivery_time'       => isset($mpDeliveryInformation['deliveryTime'])
                        ? $mpDeliveryInformation['deliveryTime'] : null,
                    'mp_house_security_code' => isset($mpDeliveryInformation['houseSecurityCode'])
                        ? $mpDeliveryInformation['houseSecurityCode'] : null,
                    'mp_delivery_comment'    => isset($mpDeliveryInformation['deliveryComment'])
                        ? $mpDeliveryInformation['deliveryComment'] : null,
                ];
            }

            return [];
        } catch (Exception $e) {
            return [];
        }
    }
}
