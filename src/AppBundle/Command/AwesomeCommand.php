<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore;


class AwesomeCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('awesome:command')
            ->setDescription('Awesome command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $obj = new \Pimcore\Model\DataObject\Demo();
        $obj->setKey('key9');
        $obj->setPublished(true);
        $obj->setParentId(16);
        $obj->setDemoSKU("1009");
        $obj->setDemoName("product9");

        $obj->save();
    }
}