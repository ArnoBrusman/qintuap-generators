<?php

namespace Qintuap\Console;
use Symfony\Component\Console\Input\InputOption;

/**
 * Description of EntityMakeCommand
 *
 * @author Premiums
 */
class EntityMakeCommand extends GeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:entity';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Entity & contract';
    
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Entity';
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->call('generate:file', [
            'name'    => $this->argumentName(),
            '--type'  => 'entity_contract', // settings type
            '--plain' => $this->optionPlain(), // if plain stub
            '--force' => $this->optionForce(), // force override
            '--stub'  => $this->optionStub(), // custom stub name
            '--name'  => $this->optionName(), // custom name for file
            '--replace'  => $this->option('replace'),
        ]);
        
        $contractName = config('generators.settings.entity_contract.namespace') . '\\' . $this->argumentName();
        
//        if($this->option('r')) {
        $this->call('generate:file', [
            'name'    => $this->argumentName(),
            '--type'  => 'model', // settings type
            '--plain' => $this->optionPlain(), // if plain stub
            '--force' => $this->optionForce(), // force override
            '--stub'  => $this->optionStub(), // custom stub name
            '--name'  => $this->optionName(), // custom name for file
            '--replace'  => 'contract|'.$contractName . ',' . $this->option('replace'),
        ]);
//        }
        
    }
    
}
