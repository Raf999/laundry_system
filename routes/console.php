<?php


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test', function () {
    \App\Models\Order::factory(10)->create();

    \App\Models\OrderItem::factory(10)->create();
});
