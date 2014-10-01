<?php
namespace Omkom\SiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\OutputInterface;

class DeployCommand extends ContainerAwareCommand
{
    private $output;
    private $method = 'update';
    
    protected function configure()
    {
        $this
            ->setName('omkom:deploy')
            ->setDescription('Mise à jour du dépot Omkom')
            ->addArgument('method', InputArgument::OPTIONAL, 'upgrade OR update BY default')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->message = false;
        
        if(isset($input))
        {
            $this->method = $input->getArgument('method');
        }
        
        $output->writeln('
[<comment>OMKOM WEB</comment>|<info>@cubilizer</info>] '.$this->method.' <comment>'.date('c').'</comment>');
        
        // if "Full Archive" method selected
        if($this->method == 'install')
        {
            $this->message = true;
            $output->writeln('<info>[Omkom]</info> '.$this->method.' <info>Git Repository Install...</info> <comment>'.date('c').'</comment>');
            system('git clone https://github.com/omkom-web/sesameGen.git . 2>&1');
            
            // then update
            $this->method = 'update';
        }
        
        if($this->method == 'upgrade')
        {
            $output->writeln('<info>[Omkom]</info> '.$this->method.' <info>Git Repository Update...</info> <comment>'.date('c').'</comment>');
            system('git pull 2>&1');
            
            // then update
            $this->method = 'update';
        }
        
        if($this->method == 'update')
        {
            $output->writeln('<info>[Omkom]</info> '.$this->method.' <info>Composer update...</info> <comment>'.date('c').'</comment>');
            system('php composer.phar update -n 2>&1');
                
            $output->writeln('
<info>[Omkom]</info> '.$this->method.' <info>Composer install...</info> <comment>'.date('c').'</comment>');
            system('php composer.phar install 2>&1');
            
            // then sync
            $this->method = 'sync';
        }
        
        $commands = array(
            'doctrine:schema:validate',
            'doctrine:schema:update --dump-sql',
            'doctrine:schema:update --force',
            'doctrine:schema:validate',
            'doctrine:mapping:info',
            'asset:install --symlink web',
            'cache:clear --no-warmup',
        );
        
        if($this->method == 'sync')
        {
            $output->writeln('
<info>[Omkom]</info> '.$this->method.' <info>Composer install...</info> <comment>'.date('c').'</comment>');
            system('php composer.phar install --no-dev --optimize-autoloader');
            $commands[] ='cache:clear --env=prod  --no-debug';
            $commands[] ='assetic:dump --env=prod --no-debug';
        }

        try {
            foreach ($commands as $command) {
                $output->writeln(sprintf('
<info>[Omkom]</info> '.$this->method.' <comment>%s</comment>... <comment>'.date('c').'</comment>', $command));

                // Run the command
                $this->runCommand($command);
            }
            $output->writeln('<info>SUCCESS</info>');
            $output->writeln('<info>Ended at : '.date('c').'</info>');
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>ERROR</error> <info>%s</info>', $e->getMessage()));
        }

        $output->writeln('<comment>Done!</comment> <comment>'.date('c').'</comment>');
        
        if($this->message)
        {
            $output->writeln('Now : <info>Create super Admin with this command:</info> <comment>php app/console fos:user:create --super-admin');
        }
        
        $output->writeln('<info>Ended at : '.date('c').'</info>');
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