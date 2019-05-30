<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:38
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudRule extends Command
{
    use CrudGeneratorInterface;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:rule
    {name : Class (singular) por exemplo User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação de uma rule';

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
                '{{className}}',
                '{{attributeName}}'
            ],
            [
                $attributesPath['name_space_class'],
                $attributesPath['class_name'],
                lcfirst($attributesPath['class_name'])
            ],
            $this->getStub('Rule')
        );
        $this->createClass('Rules', 'Rule', $attr);
    }

    /**
     * @param $path
     * @param $type
     * @param $attributesClass
     */
    private function createClass($path, $type, $attributesClass)
    {
        $attributesPath = $this->getAttributesPath();

        if (!is_dir(app_path("{$path}/{$attributesPath['path_class']}"))) {
            mkdir(app_path("{$path}/{$attributesPath['path_class']}"), 0777, true);
        }

        file_put_contents(
            app_path("{$path}/{$attributesPath['path_class']}/CheckIf{$attributesPath['class_name']}Exists{$type}.php"),
            $attributesClass
        );
    }
}
