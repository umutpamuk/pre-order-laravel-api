<?php

namespace App\Console;

use App\Enums\OrderStatusEnum;
use App\Services\Order\OrderService;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        $this->scheduleAutoReject($schedule);
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected function scheduleAutoReject($schedule)
    {
        $schedule->call(function () {

            $orderService = app(OrderService::class);
            $orders = $orderService->getAwaitingOrders();

            foreach ($orders as $order) {

                $autoRejectTime = $order->created_at->addDay();

                if ($autoRejectTime <= Carbon::now() && $order->status === OrderStatusEnum::AWAITING) {

                    $order->update(['status' => OrderStatusEnum::AUTO_REJECTED]);
                }
            }
        })->everyMinute();
    }
}
