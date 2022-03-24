<?php

namespace App\View\Components\Input;

use App\Models\Student;
use Illuminate\View\Component;

class Select extends Component
{
    public $groups;
    public $student;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $groups, ?Student $student)
    {
        $this->groups = $groups;
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.select');
    }
}
