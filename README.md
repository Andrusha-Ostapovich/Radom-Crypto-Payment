# Radom Crypto Payment Package
![Stand With Ukraine](https://vitmark.com/wp-content/uploads/2022/02/MicrosoftTeams-image-30.png)

## Introduction

Welcome to the Radom Crypto Payment Package! This package provides a simple and convenient way to integrate Radom's crypto payment system into your PHP applications.

Radom is a leading platform for processing cryptocurrency payments, offering secure and efficient solutions for businesses and individuals worldwide.

## Installation

To install the Radom Crypto Payment Package, simply use Composer:

```bash
composer require ostapovich/radom:"dev-main"
```

## Usage

### Initialization

To get started, initialize the Radom object with your API token and specify whether you want to use the test mode:

```php
use Ostapovich\Radom\Radom;

$apiToken = 'your_api_token';
$prodMode = false; // Set to false for test mode (all cryptocurrencies are displayed in the test mode), true for production mode

$radom = new Radom($apiToken, $prodMode);
```

### Creating Payment Links

The main functionality of this package is to create payment links for cryptocurrency transactions. You can create a payment link using the `createPaymentLink` method:

```php
$orderNumber = '123';
$amount = 100;
$currency = 'USD';
$successUrl = 'your_successURL';
$cancelUrl = 'cancelUrl';

$paymentLink = $radom->createPaymentLink($orderNumber, $amount, $currency, $successUrl, $cancelUrl);
```

Optionally, you can specify an array of cryptocurrencies to be accepted for payment. If not specified, all available cryptocurrencies will be used.

### Getting Payment Methods

You can also retrieve a list of available payment methods using the `getPaymentMethods` method:

```php
$paymentMethods = $radom->getPaymentMethods();
```

This method returns an array containing information about each available cryptocurrency.

## Additional Functionality

In addition to creating payment links, the Radom Crypto Payment Package also provides a method to retrieve all available payment methods supported by the Radom platform.

## Examples

Here's an example of how you might use the Radom Crypto Payment Package in a Laravel application:

```php
use Ostapovich\Radom\Radom;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $apiToken = env('RADOM_API_TOKEN');
        $prodMode = false;

        $radom = new Radom($apiToken, $prodMode);

        $orderNumber = $request->input('order_number');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $successUrl = $request->input('success_url');
        $cancelUrl = $request->input('cancel_url');

        $paymentLink = $radom->createPaymentLink($orderNumber, $amount, $currency, $successUrl, $cancelUrl);

        return redirect($paymentLink['url']);
    }
}
```

## Contribution

Contributions to the Radom Crypto Payment Package are welcome! If you find any bugs or have suggestions for improvements, please open an issue or submit a pull request on [GitHub](https://github.com/Andrusha-Ostapovich/Radom-Crypto-Payment).

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

Thank you for choosing the Radom Crypto Payment Package! We hope it serves you well in your cryptocurrency payment integration needs.

# Пакет криптовалютних платежів Radom


## Вступ

Ласкаво просимо до пакету криптовалютних платежів Radom! Цей пакет надає простий та зручний спосіб інтеграції системи криптовалютних платежів Radom у ваші PHP-додатки.

Radom є провідною платформою для обробки криптовалютних платежів, яка пропонує безпечні та ефективні рішення для бізнесу та приватних осіб по всьому світу.

## Встановлення

Для встановлення пакету криптовалютних платежів Radom просто використовуйте Composer:

```bash
composer require ostapovich/radom:"dev-main"
```

## Використання

### Ініціалізація

Для початку роботи ініціалізуйте об'єкт Radom з вашим API-токеном та вкажіть, чи бажаєте ви використовувати тестовий режим:

```php
use Ostapovich\Radom\Radom;

$apiToken = 'ваш_api_токен';
$prodMode = false; // Встановіть false для тестового режиму (в тестовому режимі виводяться всі криптовалюти), true для режиму продукції

$radom = new Radom($apiToken, $prodMode);
```

### Створення Посилань на Платіж

Основна функціональність цього пакету - створення посилань на платіж для транзакцій з криптовалютами. Ви можете створити посилання на платіж за допомогою методу `createPaymentLink`:

```php
$orderNumber = '123';
$amount = 100;
$currency = 'USD';
$successUrl = 'ваш_успішний_URL';
$cancelUrl = 'ваш_URL_скасування';

$paymentLink = $radom->createPaymentLink($orderNumber, $amount, $currency, $successUrl, $cancelUrl);
```

Необов'язково ви можете вказати масив криптовалют, які приймаються для платежу. Якщо не вказано, будуть використані всі доступні криптовалюти.

### Отримання Способів Платежу

Ви також можете отримати список доступних способів платежу за допомогою методу `getPaymentMethods`:

```php
$paymentMethods = $radom->getPaymentMethods();
```

Цей метод повертає масив, що містить інформацію про кожну доступну криптовалюту.

## Додатковий Функціонал

Крім створення посилань на платіж, пакет криптовалютних платежів Radom також надає метод для отримання всіх доступних способів платежу, підтримуваних платформою Radom.

## Приклади

Ось приклад того, як ви можете використовувати пакет криптовалютних платежів Radom у додатку на Laravel:

```php
use Ostapovich\Radom\Radom;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $apiToken = env('RADOM_API_TOKEN');
        $prodMode = false;

        $radom = new Radom($apiToken, $prodMode);

        $orderNumber = $request->input('order_number');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $successUrl = $request->input('success_url');
        $cancelUrl = $request->input('cancel_url');

        $paymentLink = $radom->createPaymentLink($orderNumber, $amount, $currency, $successUrl, $cancelUrl);

        return redirect($paymentLink['url']);
    }
}
```

## Внесок

Внесок у пакет криптовалютних платежів Radom вітається! Якщо ви знайшли помилки або маєте пропозиції щодо вдосконалення, будь ласка, відкрийте питання або надішліть запит на злиття на [GitHub](https://github.com/Andrusha-Ostapovich/Radom-Crypto-Payment).

## Ліцензія

Цей пакет є відкритим програмним забезпеченням, ліцензованим на умовах ліцензії [MIT](https://opensource.org/licenses/MIT).

---

Дякуємо за вибір пакету криптовалютних платежів Radom! Ми сподіваємося, що він буде корисним для ваших потреб інтеграції криптовалютних платежів.