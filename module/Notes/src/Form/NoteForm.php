<?php

namespace Notes\Form;

use Laminas\Form\Form;
use Laminas\Form\Element;

class NoteForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('note');

        $this->add([
            'name' => 'title',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Title',
            ],
            'attributes' => [
                'placeholder' => 'Title',
            ],
        ]);

        $this->add([
            'name' => 'content',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Content',
            ],
            'attributes' => [
                'placeholder' => "What's on your mind?",
            ],
        ]);
    }
}
