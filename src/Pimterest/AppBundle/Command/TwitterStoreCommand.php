<?php

namespace Pimterest\AppBundle\Command;

use Pimterest\AppBundle\Twitter\TwitterReader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Store raw tweets in database.
 * This command should be run in a cron to regularly strore new tweets.
 * @author JM Leroux <jean-marie.leroux@akeneo.com>
 */
class TwitterStoreCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('pimterest:twitter:store');
        $this->setDescription('Store new Akeneo Around The World tweets.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storer = $this->getTwitterStorer();
        $result = $storer->retrieve();

        $output->writeln(sprintf('<info>Done.</info> New tweets = %d', $result));

        return 0;
    }

    /**
     * @return TwitterReader
     */
    private function getTwitterStorer()
    {
        return $this->getContainer()->get('pimterest.api.storer.twitter');
    }
}
