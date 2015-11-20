<?php
/**
 * File containing the sync Imis user class.
 *
 * (c) www.aplyca.com
 * (c) Developers msanchez@aplyca.com
 */

namespace Aplyca\ContentScrubbingBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\Core\MVC\Legacy\Kernel;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class ContentScrubbingCommand extends \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('aplyca:scrub')
            ->setDescription('Scrub content')
            ->addOption(
                'dry-run',
                null,
                InputOption::VALUE_NONE,
                'If set, the sync process will be executed in preview mode'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo "Something should happen";
    }
}
