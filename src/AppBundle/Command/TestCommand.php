<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore;
use \Pimcore\Config;


class TestCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('test:command')
            ->setDescription('Test command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $somesetting = \Pimcore\Model\WebsiteSetting::getByName('ApiKey');
        $data = $somesetting->getData();
        p_r($somesetting);
        p_r($data);
    }
}