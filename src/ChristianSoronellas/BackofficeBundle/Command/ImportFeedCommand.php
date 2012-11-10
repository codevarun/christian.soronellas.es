<?php

namespace ChristianSoronellas\BackofficeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use ChristianSoronellas\BlogBundle\Entity\Post;

class ImportFeedCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('christiansoronellas:import-feed')
            ->setDescription('Imports the old RSS feed')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $feed = \Zend\Feed\Reader\Reader::import('http://christian.soronellas.es/feed/');

        foreach ($feed as $entry) {
            $output->writeln(sprintf('<comment>Importing "%s"</comment>', $entry->getTitle()));

            $post = new Post();
            $post
                ->setBody($entry->getContent())
                ->setCommentsEnabled(true)
                ->setCreatedAt($entry->getDateCreated())
                ->setState(Post::STATE_COMPLETE)
                ->setTitle($entry->getTitle())
            ;

            $em->persist($post);
            $em->flush();
        }

        $output->writeln('<info>Done.</info>');
    }
}