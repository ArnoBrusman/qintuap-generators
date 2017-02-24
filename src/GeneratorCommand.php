<?php

namespace Qintuap\Console;

use Bpocallaghan\Generators\Commands\GeneratorCommand as ParentCommand;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

abstract class GeneratorCommand extends ParentCommand
{
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->call('generate:file', [
            'name'    => $this->argumentName(),
            '--type'  => strtolower($this->type), // settings type
            '--plain' => $this->optionPlain(), // if plain stub
            '--force' => $this->optionForce(), // force override
            '--stub'  => $this->optionStub(), // custom stub name
            '--name'  => $this->optionName(), // custom name for file
            '--replace'  => $this->option('replace'),
        ]);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge([
            ['replace', 'r', InputOption::VALUE_NONE, 'Replace these values in the generated file.'],
        ], parent::getOptions());
    }

}
