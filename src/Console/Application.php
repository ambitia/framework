<?php namespace Ambitia\Console;

use Ambitia\Console\Exceptions\NoSuchCommandException;
use Ambitia\Interfaces\Console\ApplicationInterface;
use Ambitia\Interfaces\Console\CommandInterface;
use Ambitia\Interfaces\Console\RequestInterface;
use Ambitia\Interfaces\Console\ResponseInterface;

class Application implements ApplicationInterface
{
    /**
     * Registered commands. Key should be the command name.
     * @var array
     */
    protected $commands = [];

    /**
     * Request of console application
     * @var RequestInterface
     */
    protected $request;

    /**
     * Response of console application
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    public function registerCommand(string $command)
    {
        $command = new $command();
        $name = $command->getName();
        $this->commands[$name] = $command;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function registerCommands(array $commands)
    {
        foreach ($commands as $command) {
            $this->registerCommand($command);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getCommand(string $name): CommandInterface
    {
        if (!isset($this->commands[$name])) {
            throw new NoSuchCommandException($name);
        }

        return $this->commands[$name];
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $commandName = $this->request->getCommandName();
        $command = $this->getCommand($commandName);

        $command->execute($this->request, $this->response);
    }
}