<?php

class WebhookController extends Controller
{
    public function Handle()
    {
        $path = implode('/', $this->Parameters);
        var_dump($path);
        die();
    }
}