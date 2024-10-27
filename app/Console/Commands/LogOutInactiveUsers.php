<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class LogOutInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:log-out-inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Разлогинивает пользователей, которые были неактивны более одной минуты';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $inactiveTime = now()->subMinute();
        $inactiveUsers = DB::table('users')
        ->whereNotNull('last_activity')
        ->where('last_activity', '<', $inactiveTime)
        ->get();
   //
        foreach ($inactiveUsers as $user) {
                    // Удаляем сессии пользователя, чтобы разлогинить его
                    DB::table('sessions')->where('user_id', $user->id)->delete();

                    // Для тестирования можно записывать в лог информацию о разлогиненных пользователях
                    //Log::info("User {$user->id} has been logged out due to inactivity.");
                }

                $this->info('Все неактивные пользователи были разлогинены.');
    }
    }

