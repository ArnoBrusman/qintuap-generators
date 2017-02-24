<?php

namespace Qintuap\Console;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMakeCommand extends GeneratorCommand
{
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository & contract';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->call('generate:file', [
            'name'    => $this->argumentName(),
            '--type'  => 'repository_contract', // settings type
            '--plain' => $this->optionPlain(), // if plain stub
            '--force' => $this->optionForce(), // force override
            '--stub'  => $this->optionStub(), // custom stub name
            '--name'  => $this->optionName(), // custom name for file
            '--replace'  => $this->option('replace'),
        ]);
        
        $contractName = config('generators.settings.repository_contract.namespace') . '\\' . $this->argumentName();
        
//        if($this->option('r')) {
            $this->call('generate:file', [
                'name'    => $this->argumentName() . 'Repository',
                '--type'  => 'repository', // settings type
                '--plain' => $this->optionPlain(), // if plain stub
                '--force' => $this->optionForce(), // force override
                '--stub'  => $this->optionStub(), // custom stub name
                '--name'  => $this->optionName(), // custom name for file
                '--replace'  => 'contract|'.$contractName . ',' . $this->option('replace'),
            ]);
//        }
        $this->call('generate:file', [
            'name'    => $this->argumentName() . 'Cache',
            '--type'  => 'repository_decorator_cache', // settings type
            '--plain' => $this->optionPlain(), // if plain stub
            '--force' => $this->optionForce(), // force override
            '--stub'  => $this->optionStub(), // custom stub name
            '--name'  => $this->optionName(), // custom name for file
            '--replace'  => 'contract|'.$contractName. ',' . $this->option('replace'),
        ]);
    }

}
