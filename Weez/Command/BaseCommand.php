<?php

namespace Weez\Command;

use Pimple;
use Symfony\Component\Console\Command\Command;

abstract class BaseCommand extends Command
{

    /**
     * Inject container
     */
    public function setContainer(Pimple $c)
    {
        $this->c = $c;
        return $this;
    }

}
