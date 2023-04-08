<?php

namespace App\Jobs;

use App\Http\Repositories\SMSRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMSCancellation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $smsRepository;

    private $appointment;

    private $currentUserMobile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SMSRepository $smsRepository, $appointment, string $currentUserMobile)
    {
        $this->smsRepository = $smsRepository;
        $this->appointment = $appointment;
        $this->currentUserMobile = $currentUserMobile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->smsRepository->send(
                $this->smsRepository->buildMessages($this->appointment, $this->currentUserMobile)
        );
    }
}
