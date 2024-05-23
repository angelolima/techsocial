<?php

namespace App\Handlers;

class FormatDataHandler
{
    public function formatData(object $data): object
    {
        if (isset($data['pwd_hash'])) {
            $data['pwd_hash'] = base64_decode($data['pwd_hash']);
        }

        return $data;
    }
}
