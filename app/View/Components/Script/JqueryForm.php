<?php

namespace App\View\Components\Script;

use Illuminate\View\Component;

class JqueryForm extends Component
{
    /**
     * Jquery Table Id
     *
     * @var string
     */
    public string $formId;

    /**
     * Jquery Table Data
     *
     * @var array
     */
    public array $formData;

    public function __construct(string $formId = null, array $formData = [])
    {
        $this->formId = $formId;
        $this->formData = $formData;
    }

    /**
     * Jquery Table Render
     *
     * @return \Closure|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|string
     */
    public function render()
    {
        $data = [
            'formId' => $this->formId,
            'formData' => $this->formData,
        ];

        return view('components.scripts.jquery-form', compact('data'));
    }
}
