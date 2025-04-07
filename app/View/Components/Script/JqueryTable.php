<?php

namespace App\View\Components\Script;

use Illuminate\View\Component;

class JqueryTable extends Component
{
    /**
     * Jquery Table Id
     *
     * @var string
     */
    public string $tableId;

    /**
     * Jquery Table Data
     *
     * @var array
     */
    public array $tableData;

    public function __construct(string $tableId = null, array $tableData = [])
    {
        $this->tableId = $tableId;
        $this->tableData = $tableData;
    }

    /**
     * Jquery Table Render
     *
     * @return \Closure|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|string
     */
    public function render()
    {
        $data = [
            'tableId' => $this->tableId,
            'tableData' => $this->tableData,
        ];

        return view('components.scripts.jquery-table', compact('data'));
    }
}
