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

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Store\Model\ScopeInterface;
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
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Delivery constructor.
     *
     * @param MpDtHelper $mpDtHelper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        MpDtHelper $mpDtHelper,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->mpDtHelper  = $mpDtHelper;
        $this->scopeConfig = $scopeConfig;
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
        if (!$this->scopeConfig->isSetFlag('mpdeliverytime/general/enabled', ScopeInterface::SCOPE_STORE)) {
            return [];
        }
        $dateOffArr = array_values($this->mpDtHelper->getDateOff());
        $dateOff    = [];
        foreach ($dateOffArr as $date) {
            $dateOff[] = array_values($date)[0];
        }

        return [
            'isEnabledDeliveryTime'      => $this->mpDtHelper->isEnabledDeliveryTime(),
            'isEnabledHouseSecurityCode' => $this->mpDtHelper->isEnabledHouseSecurityCode(),
            'isEnabledDeliveryComment'   => $this->mpDtHelper->isEnabledDeliveryComment(),
            'deliveryDateFormat'         => $this->mpDtHelper->getDateFormat(),
            'deliveryDaysOff'            => $this->mpDtHelper->getDaysOff(),
            'deliveryDateOff'            => $dateOff,
            'deliveryTime'               => $this->mpDtHelper->getDeliveryTIme()
        ];
    }
}
