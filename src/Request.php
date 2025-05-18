<?php

declare(strict_types=1);

namespace Modularis;

class Request
{
    public array $params = [];
    public \stdClass | null $body = null;
    public array $query = [];
    public array $headers = [];

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->body = json_decode(file_get_contents('php://input'));
        $this->query = $_GET;
        $this->headers = $_SERVER;
    }
}