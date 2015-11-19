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

class SyncImisUserCommand extends \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('hrs:syncimisuser')
            ->setDescription('Sync IMIS user by IMIS Ids separated by comma')
            ->addArgument(
                'imisid',
                InputArgument::REQUIRED,
                'Imis Id of the user'
            )
            ->addOption(
                'dry-run',
                null,
                InputOption::VALUE_NONE,
                'If set, the sync process will be executed in preview mode'
            )
        ;
    }

    /**
     * @return \eZ\Publish\Core\MVC\Legacy\Kernel
     */
    protected function getLegacyKernel()
    {
        $legacyKernelClosure = $this->getContainer()->get('ezpublish_legacy.kernel');

        return $legacyKernelClosure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $imisID = $input->getArgument('imisid');
        $imisIDs = explode(",", $imisID);

        return $this->getLegacyKernel()->runCallback(
            function () use ($imisIDs)
            {
                $syncManager = new \IMISSyncManager();
                $syncManager->setOutputHandler(\eZCLI::instance());
                $syncManager->processBlock($imisIDs);
            }
        );
    }
}
