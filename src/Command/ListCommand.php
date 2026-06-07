<?php

declare (strict_types=1);
namespace Rector\Jack\Command;

use Jack202606\Entropy\Console\Contract\CommandInterface;
use Jack202606\Entropy\Console\Enum\ExitCode;
use Jack202606\Entropy\Console\Output\HelpPrinter;
use Jack202606\Entropy\Container\Container;
final class ListCommand implements CommandInterface
{
    /**
     * @readonly
     * @var \Entropy\Container\Container
     */
    private $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    public function run() : int
    {
        // resolved lazily to avoid circular dependency: ListCommand → HelpPrinter → CommandRegistry → ListCommand
        $helpPrinter = $this->container->make(HelpPrinter::class);
        $helpPrinter->print();
        return ExitCode::SUCCESS;
    }
    public function getName() : string
    {
        return 'list';
    }
    public function getDescription() : string
    {
        return 'List available commands';
    }
}
