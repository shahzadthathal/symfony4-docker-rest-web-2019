<?php
// src/Command/ContentCheckerCommand.php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Entity\Content;

class ContentCheckerCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:content-checker';

    public function __construct(ContainerInterface $container)
	{
    	parent::__construct();
    	$this->container = $container;
	}
    

    protected function configure()
    {
        $this->setDescription('Check content status.')->setHelp('This command will check content status updated or not with in a time period i.e. 5 minutes...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$em = $this->container->get('doctrine')->getManager();
        
        $items = $em->createQuery('SELECT id,email FROM App\Entity\Content c WHERE date(created_at) >= NOW() - INTERVAL 5 MINUTE AND status = "Pending"')
	        ->getResult();

        echo count($items);

        #Send email if any content not approved with in 5 minutes

    }
}