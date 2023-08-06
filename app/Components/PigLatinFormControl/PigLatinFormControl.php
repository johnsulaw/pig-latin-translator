<?php declare(strict_types=1);

namespace App\Components\PigLatinFormControl;

use App\Services\TranslatePigLatinService;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class PigLatinFormControl extends Control
{
    public function __construct(private TranslatePigLatinService $translatePigLatinService
    )
    {
    }

    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__ . '/default.latte');
        $this->getTemplate()->render();
    }

    public function createComponentForm(): Form
    {
        $form = new Form;

        $form->addTextArea('text', 'Input text', 75, 7)
            ->setRequired();

        $form->addSubmit('send', 'Translate');

        $form->onSuccess[] = [$this, 'process'];

        return $form;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues('array');

        $translatedString = '';

        $splitInput = array_filter(explode(' ', $values['text']));

        foreach ($splitInput as $word) {
            $translatedString .= $this->translatePigLatinService->translate($word) . ' ';
        }

        $this->presenter->template->translatedText = $translatedString;
    }
}
