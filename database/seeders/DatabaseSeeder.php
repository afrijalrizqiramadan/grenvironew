<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            VillagesSeeder::class,
        ]);
        $this->call(AdministratorsSeeder::class);
        $this->call(BufferCustomerHistorySeeder::class);
        $this->call(BufferCustomerSeeder::class);
        $this->call(CostSeeder::class);
        $this->call(CustomersSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(FuelSeeder::class);
        $this->call(InvoicesSeeder::class);
        $this->call(KendaraanSeeder::class);
        $this->call(MaitenancesSeeder::class);
        $this->call(TechniciansSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(TransaksiSeeder::class);
        $this->call(TripDestinationsSeeder::class);
        $this->call(TripsSeeder::class);
        $this->call(UserRolePermissionSeeder::class);

    }
}
