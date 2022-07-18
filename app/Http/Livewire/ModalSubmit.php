<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalSubmit extends Component
{
    public $modal,$title, $description;

    public function mount($modal,$title,$description)
    {
        $this->modal = $modal;
        $this->title = $title;
        $this->description = $description;
    }
    public function render()
    {
        return view('livewire.modal-submit',[
            'name' => $this->modal,
            'title' => $this->title,
            'description' => $this->description
        ]);
    }
}
