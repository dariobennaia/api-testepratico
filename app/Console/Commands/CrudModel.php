<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:34
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudModel extends Command
{
    use CrudGeneratorInterface;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:model
    {name : Class (singular) por exemplo User}
    {--table-name= : Nome ta tabela (singular) por exemplo user}
    {--attributes=* : Nome dos atributos (singular) por exemplo id}'
    ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação do model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $attributesPath = $this->getAttributesPath();

        $fill = $this->option('attributes');
        $tableName = $this->option('table-name');

        $attr = str_replace(
            [
                '{{className}}',
                '{{fill}}',
                '{{tableName}}'
            ],
            [
                $attributesPath['class_name'],
                implode("','", $fill),
                $tableName
            ],
            $this->getStub('Model')
        );

        $this->createClass($attributesPath['class_name'], $attr);
    }

    /**
     * @param $modelNameClass
     * @param $attr
     */
    private function createClass($modelNameClass, $attr)
    {
        file_put_contents(app_path("/{$modelNameClass}.php"), $attr);
    }
}
