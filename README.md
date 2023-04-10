Bu paket **Paytr** den laravel ile direct api, iframe api ve iframe havale eft  ödeme seçeneklerini kullanarak ödeme alabilmek için geliştirilmiştir.

**Nasıl Kurarım?**

```
composer require past/paytr

```

Config dosyası için kodu çalıştıralım.

```
php artisan vendor:publish --provider="Past\Paytr\PaytrServiceProvider"

```

.env ye bunları ekleyelim

```
PAYTR_MERCHANT_ID=''  
PAYTR_MERCHANT_SALT=''  
PAYTR_MERCHANT_KEY=''  
PAYTR_SUCCESS_URL='https://your-domain/success-payment'  
PAYTR_FAIL_URL='https://your-domain/fail-payment'  
PAYTR_TEST_MODE=true
```

**Examples**

Öd
Diğer Ödeme Yöntemleri İçin;
1 - Direk Api Kıllanımı 

    $payment->getOption()->setTransactionType(TransactionType::DIRECT);

2- İframe Api Kullanımı

    $payment->getOption()->setTransactionType(TransactionType::IFRAME);

3- İframe Havale/Eft Api Kullanımı

    $payment->getOption()->setTransactionType(TransactionType::IFRAME_TRANSFER);

şeklinde kullanabilirsiniz.



      $payment = new Payment(config('paytr.credentials'), config('paytr.options'));  
      $payment->getOption()->setTransactionType(TransactionType::DIRECT);  
      $payment->getOption()->setDebugOn(true);  
      $payment->getOption()->setTestMode(true);  
      
      
      $orderBasket = new Basket();  
      $product = new Product();  
      $product  
      ->setName('Ürün Adı 1')  
     ->setPrice(18.00);  
      $orderBasket->addProduct($product, 1);  
      $product = new Product();  
      $product  
      ->setName('Ürün Adı 1')  
     ->setPrice(18.00);  
      $orderBasket->addProduct($product, 1);  
      
      $paymentOrder = new Order();  
      $paymentOrder->setCardOwner("PAYTR TEST");  
      $paymentOrder->setCardNumber("4355084355084358");  
      $paymentOrder->setCardExpireMonth("12");  
      $paymentOrder->setCardExpireYear("24");  
      $paymentOrder->setCardCvv("000");  
      $paymentOrder->setUserName('User Name');  
      $paymentOrder->setUserAddress('User Address');  
      $paymentOrder->setEmail('example@mail.com');  
      $paymentOrder->setUserPhone('55512345670');  
      $paymentOrder->setUserIp('176.240.120.7');  
      $paymentOrder->setMerchantOrderId('HOMEORDER113');  
      $paymentOrder->setPaymentAmount(99.90);  
      $paymentOrder->setBasket($orderBasket);  
      
      $payment->setOrder($paymentOrder);  
      
     return $payment->call();
