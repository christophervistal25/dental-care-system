<?php

namespace App\Jobs;

use App\Http\Repositories\SMSRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class NotifyCater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $smsRepository;

    protected $patient_mobile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SMSRepository $smsRepo, string $patient_mobile)
    {
        $this->smsRepository = new $smsRepo;
        $this->patient_mobile = $patient_mobile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = new SendMessageRequest([
            'phoneNumber' => $this->patient_mobile,
            'message' => 'Please get ready in 1 hour you will be the next patient.',
            'deviceId' => config('sms.deviceId'),
        ]);
       $this->smsRepository->send([$message]);
    }
}
