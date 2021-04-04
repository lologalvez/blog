<?php

namespace App\Tests\unit\Controller;

use App\Infrastructure\Request;

use function json_encode;

class RequestBuilder
{
    private string $uri;
    private string $method;
    private string $content;
    private array $parameters;
    private array $cookies;
    private array $files;
    private array $server;

    public static function aRequest(): self
    {
        $builder = new self();
        $builder->uri = 'any-uri';
        $builder->method = 'any-method';
        $builder->parameters = [];
        $builder->cookies = [];
        $builder->files = [];
        $builder->server = ['HTTP_HOST' => 'blog.devel'];
        $builder->content = '{}';

        return $builder;
    }

    public static function post(): self
    {
        $builder = self::aRequest();
        $builder->withMethod('POST');

        return $builder;
    }

    public function to(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    private function withMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function withFormFields(array $formFields): self
    {
        $this->content = json_encode($formFields);

        return $this;
    }

    public function build(): Request
    {
        return Request::create(
            $this->uri,
            $this->method,
            $this->parameters,
            $this->cookies,
            $this->files,
            $this->server,
            $this->content
        );
    }
}
