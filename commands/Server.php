<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Server extends Command
{

	private $_host;
	private $_port;

    protected function configure()
    {
        $this
            ->setName('serve')
            ->addArgument('host', InputArgument::OPTIONAL)
            ->addArgument('port', InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$this->_host = $input->getArgument('host') == '' ? '127.0.0.1' : $input->getArgument('host'); 
    	$this->_port = $input->getArgument('port') == '' ? '8000' : $input->getArgument('port'); 

        $output->writeln("<info>Development server started:</info> <http://{$this->_host}:{$this->_port}>");
        passthru($this->serverCommand());
    }

    protected function serverCommand(){
    	return sprintf('%s -S %s:%s',
            'php',
            $this->_host,
            $this->_port
        );
    }
}