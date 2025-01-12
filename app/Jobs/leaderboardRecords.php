<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Leaderboard;
use Carbon\Carbon;

class leaderboardRecords implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $array; 
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->array = $array;  
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $inLeaderboard = Leaderboard::where('user_id', $this->array['user_id'])->first();
        if ($inLeaderboard) {
            $result = $inLeaderboard;
        }else{
            $result = new Leaderboard;
        }

        $result->user_id = $this->array['user_id'];
        $result->point = $this->array['point'];
        $result->week_num = Carbon::now()->weekOfYear;
        $result->month = Carbon::now()->month;
        $result->state = 1;
        $result->save();
    }

    public function failed($e)
    {
        dd($e);
    }
}
