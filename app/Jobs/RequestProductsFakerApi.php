<?php

namespace App\Jobs;

use App\Repositories\ProductRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RequestProductsFakerApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const FAKER_API_PRODUCTS_URL = 'https://fakerapi.it/api/v1/products?_quantity=';

    protected $quantity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProductRepository $productRepository)
    {
        Log::info("Starting job (products) with quantity: {$this->quantity}");
        $response = Http::get(self::FAKER_API_PRODUCTS_URL . $this->quantity);
        $collection = $response->collect('data');
        if ($response->failed()) {
            Log::info("Error on get products in faker api: ", [
                'exception' => $response->toException()
            ]);
            return;
        }
        $collection->transform(function ($product) {
            return [
                'name' => $product['name'],
                'description' => $product['description'],
                'ean' => $product['ean'],
                'upc' => $product['upc'],
                'image' => $product['image'],
                'net_price' => floatval($product['net_price']),
                'taxes' => floatval($product['taxes']),
                'price' => floatval($product['price']),
                'created_at' => now(),
                'updated_at' => now()
            ];
        });
        $productRepository->insertMany($collection->all());
        Log::info("Finished job (products) with quantity: {$this->quantity}");
    }
}
