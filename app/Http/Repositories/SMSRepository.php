<?php

namespace App\Http\Repositories;

use App\Appointment;

class SMSRepository
{
    private $apiClient;

    public function __construct()
    {
    }

    public function buildMessages(Appointment $appointment, string $currentUserMobile)
    {
    }

    public function send(array $clients = [])
    {
        return $this->apiClient->sendMessages($clients);
    }
}
