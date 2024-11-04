<?php

namespace Database\Seeders;

use App\Enums\Country;
use App\Enums\Currency;
use App\Enums\PackageType;
use App\Enums\Unit;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\Exporter;
use App\Models\Payorder;
use App\Models\PayorderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Utilities\ConsigmentUtility;
use App\Utilities\PayorderUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;


class PayorderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        Payorder::select('*')->delete();

        foreach(Consignment::all() as $key => $con){


            $items = [];
            foreach ($con->items as $item) {
                array_push($items,[
                        "product_id" => $item->product_id,
                        "name" => $item->product->name,
                        "invoice_value" => $item->total,
                        "freight" => 123,
                        "exchange_rate" => 12,
                        "ins_memo" => 13,
                        "landing_charges" => 1,
                        "total_gif" => 12,
                        "custom_duty" => 1,
                        "sale_tax" => 1,
                        "income_tax" => 1,
                        "rd" => 1,
                        "cd" => 1,
                        "st" => 1,
                        "eto" => 1,
                        "psw_fee" => 1,
                        "stan_duty" => 1,
                        "dlap_fee" => 1,
                        "total" => 1,
                ]);
            }

            
            PayorderUtility::create([
                "date" => Carbon::now(),
                "consignment_id" => $con->id,
                "items" => $items,
                "footer" => [
                    ["title" => "Title 1","amount" => 0123,"company" => "Company 1"],
                    ["title" => "Title 2","amount" => 012123,"company" => "Company 2"],
                    ["title" => "Title 3","amount" => 012323,"company" => "Company 3"]
                 ],
                "created_by" => User::where('status',1)->where('role_id',2)->inRandomOrder()->first()->id,
            ]);
            
        }

    }

}
