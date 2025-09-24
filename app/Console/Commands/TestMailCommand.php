<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-mail-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        // Kirim email sederhana
        Mail::raw('Tes kirim email dari Laravel 🚀', function ($message) use ($email) {
            $message->to($email)->subject('Coba Email Laravel');
        });

        $this->info("✅ Email berhasil dikirim ke {$email}");
    }
}
