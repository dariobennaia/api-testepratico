<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:32
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudController extends Command
{
    use CrudGeneratorInterface;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:controller
    {name : Class (singular) por exemplo User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação do controller';

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
        $attr = str_replace(
            [
                '{{nameSpaceClass}}',
                '{{nameSpaceUseClass}}',
                '{{className}}',
                '{{attributeNameService}}',
            ],
            [
                $attributesPath['name_space_class'],
                $attributesPath['name_space_use_class'],
                $attributesPath['class_name'],
                lcfirst($attributesPath['class_name'])
            ],
            $this->getStub('Controller')
        );
        $this->createClass('/Http/Controllers', 'Controller', $attr);
    }
}
