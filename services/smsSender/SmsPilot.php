<?php

namespace app\services\smsSender;

use RuntimeException;

/** @see https://smspilot.ru/apikey.php?tab=api1 */
readonly class SmsPilot implements SmsSender
{
    public function __construct(private string $apiKey, private string $url = 'https://smspilot.ru/api.php')
    {
    }

    public function send(string|array $to, string $message): void
    {
        if (is_array($to)) {
            $to = implode(',', $to);
        }
        
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'apikey' => $this->apiKey,
            'to'     => '+' . trim($to, '+'),
            'send'   => $message
        ]);
        curl_exec($ch);

        if (curl_errno($ch)) {
            throw new RuntimeException('Could not send request: ' . curl_error($ch));
        }

        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($resultStatus !== 200) {
            throw new RuntimeException('Request failed: HTTP status code: ' . $resultStatus);
        }

        curl_close($ch);
    }


}