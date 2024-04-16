<?php

use PHPUnit\Framework\TestCase;
use Ostapovich\Radom\Radom;

class RadomTest extends TestCase
{
    protected $apiToken = 'your_api_token';

    public function testGetPaymentMethods()
    {
        $radom = new Radom($this->apiToken);

        // Перевірка, чи повертається масив
        $this->assertIsArray($radom->getPaymentMethods());

        // Перевірка, чи масив має принаймні один елемент
        $this->assertNotEmpty($radom->getPaymentMethods());
    }

    public function testCreateProduct()
    {
        $radom = new Radom($this->apiToken);
        $orderNumber = '123456';
        $amount = 100.00;
        $currency = 'USD';

        // Перевірка, чи повертається масив
        $this->assertIsArray($radom->createProduct($orderNumber, $amount, $currency));

        // Перевірка, чи масив має ключ 'id'
        $this->assertArrayHasKey('id', $radom->createProduct($orderNumber, $amount, $currency));
    }

    public function testCreatePaymentLink()
    {
        $radom = new Radom($this->apiToken);
        $orderNumber = '123456';
        $amount = 100.00;
        $currency = 'USD';
        $successUrl = 'https://example.com/success';
        $cancelUrl = 'https://example.com/cancel';

        // Перевірка, чи повертається масив
        $this->assertIsArray($radom->createPaymentLink($orderNumber, $amount, $currency, $successUrl, $cancelUrl));
        
        // Перевірка, чи масив має ключ 'url'
        $this->assertArrayHasKey('url', $radom->createPaymentLink($orderNumber, $amount, $currency, $successUrl, $cancelUrl));
    }
}
