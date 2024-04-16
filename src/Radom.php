<?php

namespace Ostapovich\Radom;

class Radom
{
    protected string $apiToken;
    protected $prodMode;
    protected $url = 'https://api.radom.com';

    public function __construct($apiToken, $prodMode = false)
    {
        $this->apiToken = $apiToken;
        $this->prodMode = $prodMode;
    }

    public function getPaymentMethods(): array
    {
        $html = file_get_contents('https://docs.radom.com/additional-resources/payment_methods/');

        $networks = [];
        preg_match_all('/<td[^>]*>(.*?)<\/td>/', $html, $matches);

        for ($i = 1; $i < count($matches[1]); $i += 3) {
            $network = trim(strip_tags($matches[1][$i]));
            $token = trim(strip_tags($matches[1][$i + 1]));

            if ($this->prodMode && strpos($network, 'Testnet') !== false) {
                continue;
            }

            if ($token === '-') {
                $networks[] = ['network' => $network];
            } else {
                $networks[] = ['network' => $network, 'token' => $token];
            }
        }
        return $networks;
    }
    public function createPaymentLink($orderNumber, $amount, $currency, $successUrl = null, $cancelUrl = null, $networks = null) : array
    {
        $product = $this->createProduct($orderNumber, $amount, $currency);
        if (!$networks) {
            $networks = $this->getPaymentMethods();
        }
        $data = [
            'products' => [$product['id']],
            'gateway' => [
                'managed' => [
                    'methods' => $networks
                ]
            ],
            'successUrl' => $successUrl,
            'cancelUrl' => $cancelUrl,
        ];

        $options = [
            'http' => [
                'header' => "Authorization: $this->apiToken\r\n" .
                    "Content-Type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($this->url . '/payment_link/create', false, $context);
        return json_decode($response, true);
    }
    public function createProduct($orderNumber, $amount, $currency): array
    {

        $data = [
            'name' => 'Order',
            'description' => 'Order number: ' . $orderNumber,
            'addOns' => [
                [
                    'name' => 'Order',
                    'price' => $amount,
                ],
            ],
            'currency' => $currency,
            'price' => $amount,
        ];

        $options = [
            'http' => [
                'header' => "Authorization: $this->apiToken\r\n" .
                    "Content-Type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($this->url . '/product/create', false, $context);
        $product = json_decode($response, true);

        return $product;
    }
}
