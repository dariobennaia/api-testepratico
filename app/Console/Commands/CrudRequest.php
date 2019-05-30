<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:37
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudRequest extends Command
{
    use CrudGeneratorInterface;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:request
    {name : Class (singular) por exemplo User}
    {--attributes=* : nome dos atributos (singular) por exemplo nome}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação do request';

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
        $this->requestCreate();
        $this->requestUpdate();
        $this->requestStatus();
    }

    protected function requestCreate()
    {
        $attributesPath = $this->getAttributesPath();
        $fill = $this->option('attributes');

        $attr = str_replace(
            [
                '{{nameSpaceClass}}',
                '{{className}}',
                '{{rules}}',
                '{{messages}}'
            ],
            [
                $attributesPath['name_space_class'],
                $attributesPath['class_name'] . 'Create',
                "'" . implode("' => 'required',\n" . str_repeat(' ', 12) . "'", $fill) . "' => 'required'",
                "'" . implode(".required' => 'Este campo é obrigatorio',\n" . str_repeat(' ', 12) . "'", $fill) . ".required' => 'Este campo é obrigatório!'",
            ],
            $this->getStub('Request')
        );
        $this->createClass('/Http/Requests', 'Create' . 'Request', $attr);
    }

    protected function requestUpdate()
    {
        $attributesPath = $this->getAttributesPath();

        $attr = str_replace(
            [
                '{{nameSpaceClass}}',
                '{{className}}',
                '{{rules}}',
                '{{messages}}'
            ],
            [
                $attributesPath['name_space_class'],
                $attributesPath['class_name'] . 'Update',
                "'id' => [new \App\Rules{$attributesPath['name_space_class']}\CheckIf{$attributesPath['class_name']}ExistsRule(\$this->id)]",
                "",
            ],
            $this->getStub('Request')
        );
        $this->createClass('/Http/Requests', 'Update' . 'Request', $attr);
    }

    protected function requestStatus()
    {
        $attributesPath = $this->getAttributesPath();

        $attr = str_replace(
            [
                '{{nameSpaceClass}}',
                '{{className}}',
                '{{rules}}',
                '{{messages}}'
            ],
            [
                $attributesPath['name_space_class'],
                $attributesPath['class_name'] . 'Status',
                "'id' => [new \App\Rules{$attributesPath['name_space_class']}\CheckIf{$attributesPath['class_name']}ExistsRule(\$this->id)]",
                "",
            ],
            $this->getStub('Request')
        );
        $this->createClass('/Http/Requests', 'Status' . 'Request', $attr);
    }
}
