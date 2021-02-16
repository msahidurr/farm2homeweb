<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        Validator::extend('phone_number', function($attribute, $value, $parameters)
        {
          if(substr($value, 0, 3) == '013'){
            return true;
          }elseif(substr($value, 0, 3) == '014'){
            return true;
          }elseif(substr($value, 0, 3) == '015'){
            return true;
          }elseif(substr($value, 0, 3) == '016'){
            return true;
          }elseif(substr($value, 0, 3) == '017'){
            return true;
          }elseif(substr($value, 0, 3) == '018'){
            return true;
          }elseif(substr($value, 0, 3) == '019'){
            return true;
          }

          return false;
        });
        
        if(file_exists(storage_path('installed'))){
            $result = array();
            $orders = DB::table('orders')
            ->leftJoin('customers','customers.customers_id','=','orders.customers_id')
            ->where('orders.is_seen','=', 0)
            ->orderBy('orders_id','desc')
            ->get();

            $index = 0;
            foreach($orders as $orders_data){

              array_push($result,$orders_data);
              $orders_products = DB::table('orders_products')
                ->where('orders_id', '=' ,$orders_data->orders_id)
                ->get();

              $result[$index]->price = $orders_products;
              $result[$index]->total_products = count($orders_products);
              $index++;
            }

            //new customers
            $newCustomers = DB::table('users')
                ->where('is_seen','=', 0)
                ->orderBy('id','desc')
                ->get();

            //products low in quantity
            $lowInQunatity = DB::table('products')
              ->LeftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
              ->whereColumn('products.products_quantity', '<=', 'products.low_limit')
              ->where('products_description.language_id', '=', '1')
              ->where('products.low_limit', '>', 0)
              //->get();
              ->paginate(10);

            $languages = DB::table('languages')->get();
            view()->share('languages', $languages);

            $web_setting = DB::table('settings')->get();
            view()->share('web_setting', $web_setting);

            view()->share('unseenOrders', $result);
            view()->share('newCustomers', $newCustomers);
            view()->share('lowInQunatity', $lowInQunatity);
        }
    }
}
