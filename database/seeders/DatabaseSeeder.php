<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        // --------------------
        // Staffs
        // --------------------
        $this->call(StaffSeeder::class);
//
//        // --------------------
//        // Customers
//        // --------------------
//        $john = Customer::create([
//            'name' => 'John Doe',
//            'phone' => '1234567890',
//            'email' => 'john@example.com',
//            'address' => '123 Main Street',
//            'user_id' => null,
//        ]);
//
//        $jane = Customer::create([
//            'name' => 'Jane Smith',
//            'phone' => '9876543210',
//            'email' => 'jane@example.com',
//            'address' => '456 Side Avenue',
//            'user_id' => null,
//        ]);
//
//        $mike = Customer::create([
//            'name' => 'Mike Johnson',
//            'phone' => '5551234567',
//            'email' => 'mike@example.com',
//            'address' => '789 Elm Street',
//            'user_id' => null,
//        ]);
//
//        // --------------------
//        // Clothing Types
//        // --------------------
//        $shirt = ClothingType::create(['type' => 'Shirt', 'color' => 'White']);
//        $trouser = ClothingType::create(['type' => 'Trouser', 'color' => 'Black']);
//        $jacket = ClothingType::create(['type' => 'Jacket', 'color' => 'Blue']);
//        $dress = ClothingType::create(['type' => 'Dress', 'color' => 'Red']);
//
//        // --------------------
//        // Services
//        // --------------------
//        $washing = Service::create(['name' => 'Washing', 'description' => 'Machine wash']);
//        $ironing = Service::create(['name' => 'Ironing', 'description' => 'Press with iron']);
//        $dryCleaning = Service::create(['name' => 'Dry Cleaning', 'description' => 'Chemical cleaning']);
//
//        // --------------------
//        // Pricing
//        // --------------------
//        Pricing::create(['clothing_type_id' => $shirt->id, 'service_id' => $washing->id, 'price' => 5.00]);
//        Pricing::create(['clothing_type_id' => $shirt->id, 'service_id' => $ironing->id, 'price' => 3.00]);
//        Pricing::create(['clothing_type_id' => $trouser->id, 'service_id' => $washing->id, 'price' => 6.00]);
//        Pricing::create(['clothing_type_id' => $jacket->id, 'service_id' => $dryCleaning->id, 'price' => 10.00]);
//        Pricing::create(['clothing_type_id' => $dress->id, 'service_id' => $washing->id, 'price' => 8.00]);
//
//        // --------------------
//        // Orders
//        // --------------------
//        $order1 = Order::create([
//            'customer_id' => $john->id,
//            'Staff_id' => $frontdeskEmp->id,
//            'order_date' => Carbon::today()->subDays(1),
//            'status' => 'processing',
//        ]);
//
//        $order2 = Order::create([
//            'customer_id' => $jane->id,
//            'Staff_id' => $frontdeskEmp->id,
//            'order_date' => Carbon::today(),
//            'status' => 'processing',
//        ]);
//
//        // --------------------
//        // Clothing Items
//        // --------------------
//        $shirtItem = ClothingItem::create([
//            'customer_id' => $john->id,
//            'clothing_type_id' => $shirt->id,
//            'status' => 'pending',
//        ]);
//
//        $trouserItem = ClothingItem::create([
//            'customer_id' => $john->id,
//            'clothing_type_id' => $trouser->id,
//            'status' => 'pending',
//        ]);
//
//        $jacketItem = ClothingItem::create([
//            'customer_id' => $jane->id,
//            'clothing_type_id' => $jacket->id,
//            'status' => 'pending',
//        ]);
//
//        $dressItem = ClothingItem::create([
//            'customer_id' => $jane->id,
//            'clothing_type_id' => $dress->id,
//            'status' => 'pending',
//        ]);
//
//        // --------------------
//        // Order Items
//        // --------------------
//        OrderItem::create([
//            'order_id' => $order1->id,
//            'clothing_type_id' => $shirt->id,
//            'service_id' => $washing->id,
//            'color' => $shirt->color,
//            'price' => 5.00,
//        ]);
//
//        OrderItem::create([
//            'order_id' => $order1->id,
//            'clothing_type_id' => $trouser->id,
//            'service_id' => $washing->id,
//            'color' => $trouser->color,
//            'price' => 6.00,
//        ]);
//
//        OrderItem::create([
//            'order_id' => $order2->id,
//            'clothing_type_id' => $jacket->id,
//            'service_id' => $dryCleaning->id,
//            'color' => $jacket->color,
//            'price' => 10.00,
//        ]);
//
//        OrderItem::create([
//            'order_id' => $order2->id,
//            'clothing_type_id' => $dress->id,
//            'service_id' => $washing->id,
//            'color' => $dress->color,
//            'price' => 8.00,
//        ]);
//
//        // --------------------
//        // Invoices
//        // --------------------
//        $invoice1 = Invoice::create([
//            'invoice_number' => 'INV-' . Str::upper(Str::random(6)),
//            'order_id' => $order1->id,
//            'total_amount' => 11.00,
//            'status' => 'unpaid',
//        ]);
//
//        $invoice2 = Invoice::create([
//            'invoice_number' => 'INV-' . Str::upper(Str::random(6)),
//            'order_id' => $order2->id,
//            'total_amount' => 18.00,
//            'status' => 'unpaid',
//        ]);
//
//        // --------------------
//        // Payments
//        // --------------------
//        Payment::create([
//            'payment_number' => 'PAY-' . Str::upper(Str::random(6)),
//            'invoice_id' => $invoice1->id,
//            'amount' => 11.00,
//            'method' => 'cash',
//            'payment_date' => Carbon::now(),
//        ]);
//
//        Payment::create([
//            'payment_number' => 'PAY-' . Str::upper(Str::random(6)),
//            'invoice_id' => $invoice2->id,
//            'amount' => 18.00,
//            'method' => 'card',
//            'payment_date' => Carbon::now(),
//        ]);
    }
}
