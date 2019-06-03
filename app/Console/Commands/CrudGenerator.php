<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:31
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate
    {name : Class (singular) for example User}
    {--table-name= : Class (singular) for example User}
    {--attributes=* : Class (singular) for example User}
    {search-by=id : Class (singular) for example User}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

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
        $name = $this->argument('name');
        $fills = $this->option('attributes');
        $tableName = $this->option('table-name');

        $attributes = '';
        foreach ($fills as $fill) {
            $attributes .= "--attributes={$fill} ";
        }

        Artisan::call("crud:controller {$name}");
        Artisan::call("crud:service {$name}");
        Artisan::call("crud:repository {$name}");
        Artisan::call("crud:model {$name} --table-name={$tableName} {$attributes}");
        Artisan::call("crud:migration {$name} --table-name={$tableName} {$attributes}");
        Artisan::call("crud:request {$name} {$attributes}");
        Artisan::call("crud:rule {$name}");
        Artisan::call("crud:routes {$name}");

        if ($this->confirm('Deseja executar o migrate para esse modulo?')) {
            Artisan::call("migrate");
        }

        $this->comment('CRUD gerado com sucesso!');
    }
}
