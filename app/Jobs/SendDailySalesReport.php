<?php

namespace App\Jobs;

use App\Mail\DailySalesReport;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDailySalesReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Get all order items created today
        $items = OrderItem::whereDate('created_at', today())
            ->with('product')
            ->get();

        // Send to dummy admin
        Mail::to('admin@example.com')->send(new DailySalesReport($items));
    }
}

