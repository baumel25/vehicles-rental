<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $suv = Category::firstOrCreate(
            ['slug' => 'suv'],
            ['name' => 'SUV', 'description' => 'Sport Utility Vehicles']
        );
        $sedan = Category::firstOrCreate(
            ['slug' => 'sedan'],
            ['name' => 'Sedan', 'description' => 'Luxury and comfort sedans']
        );
        $sports = Category::firstOrCreate(
            ['slug' => 'sports'],
            ['name' => 'Sports', 'description' => 'High-performance sports cars']
        );
        $motorcycle = Category::firstOrCreate(
            ['slug' => 'motorcycle'],
            ['name' => 'Motorcycle', 'description' => 'Motorcycles and scooters']
        );

        // Vehicles
        Vehicle::firstOrCreate(
            ['name' => 'Mercedes-Benz G-Class'],
            [
                'model_year' => 2025,
                'category_id' => $suv->id,
                'daily_rate' => 150.00,
                'quantity' => 3,
                'status' => 'Available',
                'fuel_type' => 'Diesel',
                'transmission' => 'Automatic',
                'seating_capacity' => 5,
                'description' => 'Luxury off-road SUV with premium interior',
            ]
        );
        Vehicle::firstOrCreate(
            ['name' => 'BMW 7 Series'],
            [
                'model_year' => 2025,
                'category_id' => $sedan->id,
                'daily_rate' => 120.00,
                'quantity' => 2,
                'status' => 'Available',
                'fuel_type' => 'Petrol',
                'transmission' => 'Automatic',
                'seating_capacity' => 5,
                'description' => 'Executive luxury sedan',
            ]
        );
        Vehicle::firstOrCreate(
            ['name' => 'Porsche 911 Carrera'],
            [
                'model_year' => 2025,
                'category_id' => $sports->id,
                'daily_rate' => 250.00,
                'quantity' => 2,
                'status' => 'Available',
                'fuel_type' => 'Petrol',
                'transmission' => 'Automatic',
                'seating_capacity' => 4,
                'description' => 'Iconic sports car with thrilling performance',
            ]
        );
        Vehicle::firstOrCreate(
            ['name' => 'Range Rover Velar'],
            [
                'model_year' => 2025,
                'category_id' => $suv->id,
                'daily_rate' => 180.00,
                'quantity' => 2,
                'status' => 'Available',
                'fuel_type' => 'Petrol',
                'transmission' => 'Automatic',
                'seating_capacity' => 5,
                'description' => 'Premium mid-size luxury SUV',
            ]
        );
        Vehicle::firstOrCreate(
            ['name' => 'Yamaha YZF-R1'],
            [
                'model_year' => 2025,
                'category_id' => $motorcycle->id,
                'daily_rate' => 80.00,
                'quantity' => 3,
                'status' => 'Available',
                'fuel_type' => 'Petrol',
                'transmission' => 'Manual',
                'seating_capacity' => 2,
                'description' => 'High-performance sport motorcycle',
            ]
        );

        // Drivers
        Driver::firstOrCreate(
            ['license_number' => 'LIC-2025-001'],
            [
                'name' => 'James Mwangi',
                'phone' => '+237 670 123 456',
                'email' => 'james.mwangi@example.com',
                'experience_years' => 8,
                'base_rate' => 50.00,
                'status' => 'Available',
                'biography' => 'Experienced chauffeur specializing in luxury vehicles and VIP transport.',
            ]
        );
        Driver::firstOrCreate(
            ['license_number' => 'LIC-2025-002'],
            [
                'name' => 'Sophie Nkwi',
                'phone' => '+237 671 234 567',
                'email' => 'sophie.nkwi@example.com',
                'experience_years' => 5,
                'base_rate' => 40.00,
                'status' => 'Available',
                'biography' => 'Professional driver with expertise in off-road and SUV tours.',
            ]
        );
        Driver::firstOrCreate(
            ['license_number' => 'LIC-2025-003'],
            [
                'name' => 'David Kamga',
                'phone' => '+237 672 345 678',
                'email' => 'david.kamga@example.com',
                'experience_years' => 12,
                'base_rate' => 60.00,
                'status' => 'Available',
                'biography' => 'Senior driver with extensive knowledge of sports car handling and performance.',
            ]
        );
        Driver::firstOrCreate(
            ['license_number' => 'LIC-2025-004'],
            [
                'name' => 'Marie Tchinda',
                'phone' => '+237 673 456 789',
                'email' => 'marie.tchinda@example.com',
                'experience_years' => 6,
                'base_rate' => 45.00,
                'status' => 'Available',
                'biography' => 'Reliable driver experienced in executive sedan transport and city tours.',
            ]
        );
        Driver::firstOrCreate(
            ['license_number' => 'LIC-2025-005'],
            [
                'name' => 'Paul Biya Jr',
                'phone' => '+237 674 567 890',
                'email' => 'paul.biya@example.com',
                'experience_years' => 10,
                'base_rate' => 55.00,
                'status' => 'Available',
                'biography' => 'Expert motorcycle guide and adventure tour specialist.',
            ]
        );
    }
}
