<?php

namespace Kava\Command\Os;

trait Manifest
{
    public function exec($command)
    {
        return (new Exec($command))->execute();
    }
}
