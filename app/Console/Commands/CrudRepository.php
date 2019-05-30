<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:36
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CrudRepository extends Command
{
    use CrudGeneratorInterface;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:repository
    {name : Class (singular) por exemplo User}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação do repository';

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
                '{{className}}'
            ],
            [
                $attributesPath['name_space_class'],
                $attributesPath['name_space_use_class'],
                $attributesPath['class_name']
            ],
            $this->getStub('Repository')
        );
        $this->createClass('Repositories', 'Repository', $attr);
    }
}
