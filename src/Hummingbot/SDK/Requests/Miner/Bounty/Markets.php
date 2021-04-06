<?php

namespace Hummingbot\SDK\Requests\Miner\Bounty;

use Hummingbot\SDK\Requests\AbstractRequest;

class Markets extends AbstractRequest
{
    public function run()
    {
        $url = 'https://api.hummingbot.io/bounty/markets';

        parent::getClient()->getConfig()->setHost($url);
        parent::setMethod('GET');
        parent::setTypeResponse('Hummingbot\SDK\Model\Markets');

        return parent::sendRequest();
    }
}