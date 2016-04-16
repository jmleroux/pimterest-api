<?php

namespace Pimterest\AppBundle\Command;

use Pimterest\AppBundle\Entity\Contribution;
use Pimterest\AppBundle\Repository\ContributionRepository;
use Pimterest\AppBundle\Twitter\TwitterReader;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
