<?php

namespace command;

use Exception;
use service\Parser;

class SbrCommand
{
    /**
     * Запуск комманды
     * @throws Exception
     */
    public function run(): void
    {
        $data = (new Parser())->parse();
        var_dump($data);
    }
}