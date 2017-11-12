<?php

namespace Hook\Traits;

trait Authenticates
{
    /**
     * The optional authorization key.
     *
     * @var string
     */
    private $secret = null;

    /**
     * The secret provided in the token header.
     *
     * @var string
     */
    private $signature;

    /**
     * Whether the request is authenticated or not.
     *
     * @var bool
     */
    private $authenticated = false;

    abstract protected function auth();

    abstract protected function validate();
}
