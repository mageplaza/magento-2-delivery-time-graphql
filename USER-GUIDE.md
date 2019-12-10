## Documentation

- Installation guide: https://www.mageplaza.com/install-magento-2-extension/#solution-1-ready-to-paste
- User Guide: https://docs.mageplaza.com/delivery-time/
- Report a security issue to security@mageplaza.com
- Product page: https://www.mageplaza.com/magento-2-delivery-time/
- Github page: https://github.com/mageplaza/magento-2-delivery-time-graphql
- FAQs: https://www.mageplaza.com/faqs/
- Get Support: https://www.mageplaza.com/contact.html or support@mageplaza.com
- Changelog: https://www.mageplaza.com/releases/delivery-time/
- License agreement: https://www.mageplaza.com/LICENSE.txt

## How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-delivery-time-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## How to use

To start working with GraphQl in Magento, you need the following:
- Use Magento 2.3.x. Returns site to developer mode
- Install [chrome extension](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij?hl=en) (currently does not support other browsers)
- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. http://develop.mageplaza.com/graphql/ce232/graphql)
- Mageplaza-supported queries are fully written in the **Description** section of `Query.deliveryTime.DeliveryInfomation`

![](https://i.imgur.com/8OW0Y2G.png)

## Support

- FAQs: https://www.mageplaza.com/faqs/
- https://www.mageplaza.com/contact.html
- support@mageplaza.com
