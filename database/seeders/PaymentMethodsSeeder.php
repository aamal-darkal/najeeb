<?php

namespace Database\Seeders;

use App\Models\Payment_method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'cash' ],
            ['name' => 'Syriatel Cash' ],
            ['name' => 'MTN Cash' ],
        ];
        foreach($paymentMethods as $paymentMethod)
            Payment_method::create($paymentMethod);

    }
}
