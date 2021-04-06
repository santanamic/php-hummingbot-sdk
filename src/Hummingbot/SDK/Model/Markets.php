<?php

namespace Hummingbot\SDK\Model;

class Markets extends AbstractFilter
{
	public $container = [];

    public function __construct(array $data = null)
    {
        $this->container = $data['markets'] ?? null;
    }
}
