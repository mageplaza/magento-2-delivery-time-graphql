# Magento 2 Delivery Time GraphQL

[Mageplaza Delivery Time for Magento 2](https://www.mageplaza.com/magento-2-delivery-time-extension/) is an effective solution that makes delivery easier and flexible for customers. 

Customers can choose their preferred delivery dates through a smart calendar right next to the delivery date box. Your days off are also displayed in the fade mode and can’t be picked up on the calendar so that customers can easily choose the perfect time for their orders to be shipped. From the admin backend, you can also set up a fixed time frame that customers can only choose from. In this way, you will have more control over the delivery times and therefore, serve customers better. 

Delivery Time for Magento 2 allows customers to leave messages on their orders so that they can communicate their specific preferences to the stores easily. Customers can note specific preferences about the location, delivery times, or anything else related to the orders to help shippers deliver the orders more easily. 

Delivery Time is a great feature included free in Mageplaza One Step Checkout for Magento 2. Customers can choose their favorite delivery time right on the shipping method section, which is convenient for them. In this way, you can improve customer satisfaction on your website and reduce an incredible number of abandoned carts during the checkout. 

Especially, **Magento 2 Delivery Time GraphQL is now a part of Mageplaza Delivery Time extension that adds GraphQL features.** This will be much helpful for PWA compatibility.

## 1. How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-delivery-time-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

**Note**
Magento 2 Delivery Time GraphQL requires installing [Mageplaza Delivery Time](https://www.mageplaza.com/magento-2-delivery-time-extension/) in your Magento installation. 

## 2. How to use

To start working with GraphQl in Magento, you need to:
- Use Magento 2.3.x. Return your site to developer mode.
- Install [chrome extension](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij?hl=en) (currently does not support other browsers)
- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. http://develop.mageplaza.com/graphql/ce232/graphql)
- Mageplaza-supported queries are fully written in the **Description** section of `Query.deliveryTime.DeliveryInfomation`

![](https://i.imgur.com/8OW0Y2G.png)

## 3. Devdocs  
- [Magenot 2 Delivery Time GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzYXWeR9?version=latest)

Click on Run in Postman to add these collections to your workspace quickly.

![Magento 2 blog graphql pwa](https://i.imgur.com/lhsXlUR.gif)

## 4. Contribute to this module 
Feel free to **Fork** and contribute to this module. You can create a pull request, so we will merge your changes in the main branch. 

## 5. Get support 
- Don't hesitate to [contact us](https://www.mageplaza.com/contact.html) if you have any question. Our support team is dedicated to finding the most practical solutions to your problems.  
- If you what you need in this post, please give it a **Star** ![star](https://i.imgur.com/S8e0ctO.png)

