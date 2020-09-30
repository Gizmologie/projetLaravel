<?php

namespace App\Services;

use Mailjet\Client;
use Mailjet\Resources;

class MailerService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * MailerService constructor.
     */
    public function __construct()
    {
        $this->client=  new Client(config('mailjet.MJ_APIKEY_PUBLIC'), config('mailjet.MJ_APIKEY_PRIVATE'), true,['version' => 'v3.1']);
    }

    /**
     * @param array $to =>  ['Email' => "receiver1@example.com",'Name' => "Receiver 1"]
     * @param string $subject => "Your email flight plan!"
     * @param string $template => 'path/to/template'
     * @param array $data => ['data_1' => 'value_1', 'data_2' => 'value_2']
     * @param array $from => ['Email' => "example@example.com",'Name' => "Sender"]
     * @return bool
     * @throws \Throwable
     */
    public function sendMail(array $to, string $subject, string $template, array $data = [], array $from = ['Email' => 'noreply@benjamin-robert.com', 'Name' => 'E-commerce Laravel']){
        $body = [
            'Messages' => [
                [
                    'From' => $from,
                    'To' => [$to],
                    'Subject' => $subject,
                    'HTMLPart' => view($template, $data)->render()
                ]
            ]
        ];
        $response = $this->client->post(Resources::$Email, ['body' => $body]);

        return $response;
    }
}
