<?php

namespace Qintuap\Console;

use Illuminate\Foundation\Console\ModelMakeCommand as ParentCommand;
use Symfony\Component\Console\Input\InputOption;

/**
 * Description of ModelMakeCommand
 *
 * @author Premiums
 */
class ModelMakeCommand extends GeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admake:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (parent::fire() === false) {
            return;
        }

        if ($this->option('migration')) {
            $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

            $this->call('make:migration', [
                'name' => "create_{$table}_table",
                '--create' => $table,
            ]);
        }

        if ($this->option('controller')) {
            $controller = Str::studly(class_basename($this->argument('name')));

            $this->call('make:controller', [
                'name' => "{$controller}Controller",
                '--resource' => $this->option('resource'),
            ]);
        }
        
        $this->buildProperties();
        
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],

            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model.'],

            ['resource', 'r', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],
        ];
    }
    
    protected function buildProperties()
    {
        
        if ($this->option('migration')) {
            
        }
    }
    
}
