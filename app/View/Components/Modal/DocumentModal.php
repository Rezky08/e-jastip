<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class DocumentModal extends Component
{
    public array $table;
    public ?string $name;
    public ?bool $isServerSide;
    public ?string $attachmentUri;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name="documentsModal",$attachmentUri="attachment",$isServerSide=false)
    {

        $this->table = [
            'Nama Dokumen' => 'name',
            'Aksi' => null,
        ];
        $this->name = $name;
        $this->isServerSide = $isServerSide;
        $this->attachmentUri = $attachmentUri;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.document-modal');
    }
}
