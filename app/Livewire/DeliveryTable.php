<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Trip;
use App\Models\Customer;
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
        return Trip::query()
            ->join('customers', 'delivery_statuses.customer_id', '=', 'customers.id')
            ->where('customers.id', $customer->id)
            ->orderByDesc('delivery_date');
    }
    public function columns(): array
    {
        return [
            // Column::make("Id", "id")
            //     ->sortable(),
            Column::make("Customer id", "customer.name")
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
