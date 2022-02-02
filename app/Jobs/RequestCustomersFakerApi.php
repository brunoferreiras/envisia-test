<?php

namespace App\Jobs;

use App\Repositories\AddressRepository;
use App\Repositories\CustomerRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RequestCustomersFakerApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const FAKER_API_CUSTOMERS_URL = 'https://fakerapi.it/api/v1/persons?_quantity=';

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
    public function handle(CustomerRepository $customerRepository, AddressRepository $addressRepository)
    {
        Log::info("Starting job (customers) with quantity: {$this->quantity}");
        $response = Http::get(self::FAKER_API_CUSTOMERS_URL . $this->quantity);
        $collection = $response->collect('data');
        if ($response->failed()) {
            Log::info("Error on get customers in faker api: ", [
                'exception' => $response->toException()
            ]);
            return;
        }
        $collection->transform(function ($person) {
            $address = $person['address'];
            return [
                'first_name' => $person['firstname'],
                'last_name' => $person['lastname'],
                'email' => $person['email'],
                'phone' => preg_replace('/[^0-9]/', '', $person['phone']),
                'birthday' => $person['birthday'],
                'gender' => $person['gender'],
                'image' => $person['image'],
                'address' => [
                    'street' => $address['street'],
                    'street_name' => $address['streetName'],
                    'building_number' => $address['buildingNumber'],
                    'city' => $address['city'],
                    'zipcode' => $address['zipcode'],
                    'country' => $address['country'],
                    'country_code' => $address['county_code'],
                    'latitude' => $address['latitude'],
                    'longitude' => $address['longitude'],
                ]
            ];
        });
        foreach ($collection as $person) {
            $created = $customerRepository->create($person);
            $address = $person['address'];
            $address['customer_id'] = $created->id;
            $addressRepository->create($address);
        }
        Log::info("Finished job (customers) with quantity: {$this->quantity}");
    }
}
