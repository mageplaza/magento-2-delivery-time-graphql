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

namespace Mageplaza\DeliveryTimeGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\DeliveryTime\Helper\Data as MpDtHelper;

/**
 * Class Delivery
 * @package Mageplaza\DeliveryTimeGraphQl\Model\Resolver
 */
class Delivery implements ResolverInterface
{
    /**
     * @var MpDtHelper
     */
    private $mpDtHelper;

    /**
     * Delivery constructor.
     *
     * @param MpDtHelper $mpDtHelper
     */
    public function __construct(
        MpDtHelper $mpDtHelper
    ) {
        $this->mpDtHelper = $mpDtHelper;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!$this->mpDtHelper->isEnabled()) {
            return [];
        }

        $dayOff = $this->mpDtHelper->getDaysOff() ? explode(',', $this->mpDtHelper->getDaysOff()) : [];

        return [
            'isEnabledDeliveryTime'      => $this->mpDtHelper->isEnabledDeliveryTime(),
            'isEnabledHouseSecurityCode' => $this->mpDtHelper->isEnabledHouseSecurityCode(),
            'isEnabledDeliveryComment'   => $this->mpDtHelper->isEnabledDeliveryComment(),
            'deliveryDateFormat'         => $this->mpDtHelper->getDateFormat(),
            'deliveryDaysOff'            => $dayOff,
            'deliveryDateOff'            => $this->getDateOff(),
            'deliveryTime'               => $this->getDeliveryTime()
        ];
    }

    /**
     * @return array
     */
    private function getDateOff()
    {
        $dateOffSetting = $this->mpDtHelper->getDateOff() ?? [];
        $dateOff        = [];
        foreach (array_values($dateOffSetting) as $date) {
            $dateOff[] = array_values($date)[0];
        }

        return $dateOff;
    }

    /**
     * @return array
     */
    private function getDeliveryTime()
    {
        $deliveryTimeSetting = $this->mpDtHelper->getDeliveryTIme() ?? [];
        $deliveryTime        = [];
        foreach (array_values($deliveryTimeSetting) as $date) {
            $deliveryTime[] = implode(':', array_values($date)[0]);
        }

        return $deliveryTime;
    }
}
