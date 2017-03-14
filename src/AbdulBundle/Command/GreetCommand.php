<?php
/**
 * Created by PhpStorm.
 * User: muhammed
 * Date: 14/3/17
 * Time: 11:58 AM
 */

namespace AbdulBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GreetCommand
 * @package AbdulBundle\Command
 *
 * Run: php app/console demo:greet Muhammed --yell=upper
 */
class GreetCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('demo:greet')
            ->setDescription('Greet someone')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_REQUIRED,
                'If set, the task will yell in uppercase letters'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Hello '.$name;
        }
        else {
            $text = 'Hello';
        }

        $optionYell = $input->getOption('yell');
        if ($optionYell == 'lower') {
            $text = strtolower($text);
        }
        else if ($optionYell == 'upper') {
            $text = strtoupper($text);
        }

        $output->writeln($text);
    }
}
