<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Bonus;
use App\Models\InsurancePoint;
use App\Models\EarnedBonusHistory;
use App\Repositories\Interfaces\EWalletRepositoryInterface;
use Carbon\Carbon;

class earnBonus implements ShouldQueue
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
        $result = new Bonus;
        $result->user_id = $this->array['payee_user_id'];
        $result->deposit = round($this->array['deposit'],2);
        $result->payor_user_id = $this->array['user_id'];
        $result->payee_user_id = $this->array['payee_user_id'];
        $result->policy_number = $this->array['policy_number'];
        $result->week_num = Carbon::now()->weekOfYear;
        $result->transaction_type = Bonus::earn;
        $result->state = 1;
        $result->save();
    }

    public function failed($e)
    {
        dd($e);
    }
}
