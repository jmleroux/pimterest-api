<?php

namespace Pimterest\AppBundle;

use Pimterest\AppBundle\Command\InstagramCommand;
use Pimterest\AppBundle\Command\TwitterCommand;
use Pimterest\AppBundle\Command\TwitterStoreCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function registerCommands(Application $application)
    {
        $application->add(new InstagramCommand());
        $application->add(new TwitterStoreCommand());
        $application->add(new TwitterCommand());
    }
}
