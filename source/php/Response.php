<?php

namespace KnowitToolsTest;

class Response
{
    /**
     * Sends a json response
     * @param  array $data  Data to display
     * @return void
     */
    public static function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
