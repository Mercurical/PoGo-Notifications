<?php

namespace AppBundle\Service\Bot;

use SkypeBot\Command\SendMessage;
use SkypeBot\Storage\FileStorage;
use SkypeBot\Config;
use SkypeBot\SkypeBot as Bot;

class SkypeBot
{
    /**
     * @var Bot
     */
    private $bot;

    public function __construct(string $apiKey, string $secret)
    {
        $dataStorage = new FileStorage(sys_get_temp_dir());
        $config = new Config(
            $apiKey,
            $secret
        );

        $this->bot = Bot::init($config, $dataStorage);
    }

    /**
     * @param $message
     * @param $recipient
     */
    public function sendMessage(string $message, string $recipient)
    {
        $this->bot->getApiClient()->call(
            new SendMessage(
                $message,
                '8:' . $recipient
            )
        );
    }
}