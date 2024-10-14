<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $paymentMethods = [
            [
                'id' => 1,
                'title' => 'Cash On Delivery',
                'slug' => 'cash_on_delivery',
                'message' => 'Cash On Delivery Message',
                'is_enable' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'title' => 'Bank Transfer',
                'slug' => 'bank_transfer',
                'message' => 'Bank Transfer Message',
                'is_enable' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('payment_methods')->insert($paymentMethods);
    }
}
