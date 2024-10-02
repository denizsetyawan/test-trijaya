<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function createTransaction(Request $request, $id)
    {
        $product = Product::find($id);
        $apiKey = env('TRIPAY_API_KEY');
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef = 'INV-' . time();

        $data = [
            'method'         => 'BRIVA',
            'merchant_ref'   => $merchantRef,
            'amount'         => $product->price,
            'customer_name'  => 'Denis Setiawan',
            'customer_email' => 'denizsetyawan95@gmail.com',
            'customer_phone' => '089696717939',
            'order_items'    => [
                [
                    'sku'       => $product->sku,
                    'name'      => $product->name,
                    'price'     => $product->price,
                    'quantity'  => 1
                ]
            ],
            'return_url'     => env('APP_URL'),
            'expired_time'   => (time() + (24 * 60 * 60)), // Expired 24 jam
            'signature'      => hash_hmac('sha256', $merchantCode.$merchantRef.$product->price, $privateKey)
        ];

        $client = new Client();
        $response = $client->post('https://tripay.co.id/api-sandbox/transaction/create', [
            'verify' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey
            ],
            'json' => $data
        ]);

        $body = $response->getBody();
        $result = json_decode($body, true);

        // insert to invoice table
        $invoice = [
            'product_id'        => $product->id,
            'tripay_reference'  => $result['data']['reference'],
            'buyer_email'       => 'denizsetyawan95@gmail.com',
            'buyer_phone'       => '089696717939',
            'raw_response'      => json_encode($result),
        ];

        Invoice::create($invoice);

        return response()->json($result);
    }
}
