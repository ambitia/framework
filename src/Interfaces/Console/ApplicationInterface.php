<?php

namespace Ambitia\Interfaces\Console;

use Ambitia\Console\Exceptions\NoSuchCommandException;

interface ApplicationInterface
{
    /**
     * Register a console command
     *
     * @param string $command Command class name
     * @return $this
     */
    public function registerCommand(string $command);

    /**
     * Register an array of console commands
     *
     * @param string[] $commands Array of command class names
     * @return $this
     */
    public function registerCommands(array $commands);

    /**
     * Find a command by the given name and return it's instance
     *
     * @param string $name
     * @throws NoSuchCommandException
     * @return CommandInterface
     */
    public function getCommand(string $name): CommandInterface;

    /**
     * Execute application logic
     *
     * @return void
     */
    public function execute();
}