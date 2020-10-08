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

namespace Mageplaza\DeliveryTimeGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\QuoteGraphQl\Model\Cart\GetCartForUser;
use Mageplaza\DeliveryTime\Helper\Data;
use Magento\Framework\GraphQl\Query\ResolverInterface;

/**
 * Class DeliveryMutation
 * @package Mageplaza\DeliveryTimeGraphQl\Model\Resolver
 */
class DeliveryMutation implements ResolverInterface
{
    /**
     * @var GetCartForUser
     */
    private $getCartForUser;

    /**
     * @var Data
     */
    private $helperData;

    /**
     * SpendingPoint constructor.
     *
     * @param GetCartForUser $getCartForUser
     * @param Data $helperData
     */
    public function __construct(
        GetCartForUser $getCartForUser,
        Data $helperData
    ) {
        $this->getCartForUser = $getCartForUser;
        $this->helperData     = $helperData;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->helperData->isEnabled()) {
            throw new GraphQlNoSuchEntityException(__('Delivery Time is disabled.'));
        }

        if ($this->helperData->versionCompare('2.3.3')) {
            $store = $context->getExtensionAttributes()->getStore();
            $quote = $this->getCartForUser->execute($args['cart_id'], $context->getUserId(), (int)$store->getId());
        } else {
            $quote = $this->getCartForUser->execute($args['cart_id'], $context->getUserId());
        }

        if ($mpDeliveryTime = $args['mp_delivery_time']) {
            $deliveryInformation = [
                'deliveryDate'      => isset($mpDeliveryTime['mp_delivery_date']) ? $mpDeliveryTime['mp_delivery_date'] : '',
                'deliveryTime'      => isset($mpDeliveryTime['mp_delivery_time']) ? $mpDeliveryTime['mp_delivery_time'] : '',
                'houseSecurityCode' => isset($mpDeliveryTime['mp_house_security_code']) ? $mpDeliveryTime['mp_house_security_code'] : '',
                'deliveryComment'   => isset($mpDeliveryTime['mp_delivery_comment']) ? $mpDeliveryTime['mp_delivery_comment'] : ''
            ];
            $quote->setData('mp_delivery_information', Data::jsonEncode($deliveryInformation))->save();
        }

        return true;
    }
}
