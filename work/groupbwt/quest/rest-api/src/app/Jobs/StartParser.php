<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class StartParser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    protected $city;
    protected $checkin;
    protected $checkout;
    protected $userId;
    protected $pythonPath;

    public function __construct($city, $checkin, $checkout, $userId)
    {
        $this->city = $city;
        $this->checkin = $checkin;
        $this->checkout = $checkout;
        $this->userId = $userId;
        $this->pythonPath = config('services.pythonPath');
    }

    public function handle()
    {
        $process = new Process('cd public\booking-spider\src\booking & ' . $this->pythonPath . ' StartParser.py --city ' . $this->city . ' --checkin ' . $this->checkin . ' --checkout ' . $this->checkout . ' --user_id ' . $this->userId);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        info($process->getOutput());
    }
}
