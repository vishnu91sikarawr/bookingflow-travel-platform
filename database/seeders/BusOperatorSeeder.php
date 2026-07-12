<?php

namespace Database\Seeders;

use App\Models\BusOperator;
use App\Models\User;
use Illuminate\Database\Seeder;

class BusOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@bookingflow.com')->first();

        $operators = [
            [
                'name' => 'GreenLine Travels',
                'code' => 'GLT001',
                'email' => 'contact@greenlinetravels.com',
                'phone' => '+91 98765 43210',
                'website' => 'https://greenlinetravels.com',
                'address' => '123 Transport Nagar, Mumbai, Maharashtra 400001',
                'description' => 'Premium intercity bus operator serving major routes across western India.',
                'status' => true,
            ],
            [
                'name' => 'Royal Express',
                'code' => 'REX002',
                'email' => 'info@royalexpress.com',
                'phone' => '+91 91234 56789',
                'website' => 'https://royalexpress.com',
                'address' => '45 Highway Road, Delhi, Delhi 110001',
                'description' => 'Luxury sleeper and semi-sleeper services on long-distance routes.',
                'status' => true,
            ],
            [
                'name' => 'City Connect Buses',
                'code' => 'CCB003',
                'email' => 'support@cityconnectbuses.com',
                'phone' => '+91 99887 76655',
                'website' => 'https://cityconnectbuses.com',
                'address' => '78 Bus Terminal, Bengaluru, Karnataka 560001',
                'description' => 'Affordable daily commuter services connecting tier-2 cities.',
                'status' => true,
            ],
        ];

        foreach ($operators as $operator) {
            BusOperator::firstOrCreate(
                ['code' => $operator['code']],
                array_merge($operator, [
                    'created_by' => $admin?->id,
                    'updated_by' => $admin?->id,
                ])
            );
        }
    }
}
