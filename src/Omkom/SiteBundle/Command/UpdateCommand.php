<?php
namespace Omkom\SiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends ContainerAwareCommand
{
    private $output;
    
    protected function configure()
    {
        $this
            ->setName('omkom:update')
            ->setDescription('Mise à jour du dépot Omkom')
            // ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
            // ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<comment>Omkom Update...</comment> <info>Symfony2</info>');
        $output->writeln('<info>composer update -n...</info>');
        system('php composer.phar update -n 2>&1');
        
        $this->output = $output;
        $commands = array(
            'doctrine:schema:validate',
            'doctrine:schema:update --dump-sql',
            'doctrine:schema:update --force',
            'doctrine:schema:validate',
            'asset:install --symlink web',
            'cache:clear --no-warmup',
            'doctrine:mapping:info',
            'cache:clear --no-warmup',
            'cache:clear --env=prod',
        );

        try {
            foreach ($commands as $command) {
                $output->writeln(sprintf('Executing command <comment>%s</comment>...', $command));

                // Run the command
                $this->runCommand($command);
            }
            $output->writeln('<info>SUCCESS</info>');
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>ERROR</error> <info>%s</info>', $e->getMessage()));
        }

        $output->writeln('<comment>Done!</comment>');
    }

    private function runCommand($string)
    {
        // Split namespace and arguments
        $namespace = explode(' ', $string)[0];

        // Set input
        $command = $this->getApplication()->find($namespace);
        $input = new StringInput($string);

        // Send all output to the console
        $returnCode = $command->run($input, $this->output);

        return $returnCode != 0;
    }
}