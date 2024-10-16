<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Order::with('product')->get(['name', 'phone', 'rec_address', 'product_id']);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone',
            'Address',
            'Product',
            'Price',
        ];
    }

    public function map($order): array
    {
        return [
            $order->name,
            "'".$order->phone,
            $order->rec_address,
            $order->product->title,
            $order->product->price,
        ];
    }
}
