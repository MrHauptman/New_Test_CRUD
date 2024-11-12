<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateProductStatsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $today = now()->startOfDay();
        $stats = DB::table('products')
            ->select(DB::raw('count(*) as total_products, owner'))
            ->where('created_at', '>=', $today)
            ->groupBy('owner')
            ->get();
            //dd($stats);

        foreach ($stats as $stat) {
            DB::table('product_statistics')->updateOrInsert(
                ['owner' => $stat->owner, 'date' => $today],
                ['total_products' => $stat->total_products]
            );
        }
    }

}
