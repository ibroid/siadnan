<?php

class ResponseJson
{
    public static function success(array $data = [], int $code = 200, string $message = "Request Success")
    {
        header("Content-Type: application/json", true, $code);

        echo json_encode([
            'data' => $data,
            'message' => $message
        ]);
    }
}
