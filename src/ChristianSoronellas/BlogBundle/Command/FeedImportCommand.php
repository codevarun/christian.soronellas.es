<?php

namespace ChristianSoronellas\BlogBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * A command line to import posts from a URI
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class FeedImportCommand extends ContainerAwareCommand
{
    /**
     * Define the command
     */
    protected function configure()
    {
        $this->setName('christiansoronellas:feed:import')
             ->setDescription('Given a Feed URI, this task will import all the posts and all the associated comments')
             ->addArgument('feed-uri', InputArgument::REQUIRED, 'The Feed URI to import');
    }

    /**
     * Execute the command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $postImporter = $this->getContainer()->get('christiansoronellas.feed.importer');
        $postImporter->setFeedUri($input->getArgument('feed-uri'));

        try {
            $postImporter->import();
            $output->writeln('Feed ' . $input->getArgument('feed-uri') . ' imported succesfully!');
        } catch(\Exception $e) {
            $output->writeln('Something went wrong! Reason: ' . $e->getMessage());
        }
    }
}