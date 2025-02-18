<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\TripDestination;
use Illuminate\Database\Eloquent\Builder;

class DeliveryTable extends DataTableComponent
{
    protected $model = Trip::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        $customer = Customer::where('id',1)->first();
        return TripDestination::query()
            ->join('buffer_customers', 'trip_destinations.buffer_customers', '=', 'buffer_customers.id')
            ->where('buffer_customers', 1)->orderBy('created_at', 'desc')
            ->orderByDesc('created_at');
    }

    public function columns(): array
    {
        return [
            // Column::make("Id", "id")
            //     ->sortable(),
            Column::make("Customer id", "buffer_customers.name")
                ->sortable(),
            Column::make("Total", "total")
                ->sortable(),
            Column::make("Delivery date", "delivery_date")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
