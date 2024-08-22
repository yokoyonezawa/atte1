<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stamp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateOvernightShifts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shifts:update-overnight';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update overnight shifts to split at midnight';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $stamps = Stamp::whereNull('end_time')->get();

        foreach ($stamps as $stamp) {
            $startTime = Carbon::parse($stamp->start_time);
            $currentTime = Carbon::now();

            // 勤務が日を跨いでいない場合はスキップ
            if ($startTime->isSameDay($currentTime)) {
                continue;
            }

            // 勤務開始日の23:59:59に終了時間を設定
            $endOfDay = $startTime->copy()->endOfDay()->subSecond();
            $stamp->end_time = $endOfDay;
            $stamp->save();

            // 新しい勤務を翌日の0:00:00に開始し、現在の時間で終了
            $startOfNextDay = $endOfDay->copy()->addSecond();
            $newStamp = new Stamp();
            $newStamp->user_id = $stamp->user_id;
            $newStamp->start_time = $startOfNextDay;
            $newStamp->end_time = $currentTime;
            $newStamp->save();

            Log::info("Overnight shift updated for user {$stamp->user_id}");
            Log::info("End of day: {$endOfDay}");
            Log::info("Start of next day: {$startOfNextDay}");

        }

        return 0;
    }
}
