<?php

namespace App\Http\Response;

use Illuminate\Http\Response;

class ApiResponse extends Response
{
    public function __construct($data = null, $status = 200, $headers = [], $options = 0)
    {
        parent::__construct($data, $status, $headers);

        $this->header('Content-Type', 'application/json');
    }

    public static function success($data = null, $status = 200, $headers = [], $options = 0)
    {
        $response = [
            'success' => true,
            'data' => $data,
        ];

        return new static($response, $status, $headers, $options);
    }

    public static function error($message = 'An error occurred', $status = 500, $headers = [], $options = 0)
    {
        $response = [
            'success' => false,
            'error' => $message,
        ];

        return new static($response, $status, $headers, $options);
    }
}
