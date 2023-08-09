<?php declare(strict_types=1);

namespace App\Components\PigLatinFormControl;

use App\Services\TranslatePigLatin\TranslatePigLatinService;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class PigLatinFormControl extends Control
{
    public function __construct(private TranslatePigLatinService $translatePigLatinService)
    {
    }

    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__ . '/default.latte');
        $this->getTemplate()->render();
    }

    protected function createComponentForm(): Form
    {
        $form = new Form;

        $form->addTextArea('text', 'Input text', 75, 7)
            ->setHtmlAttribute('placeholder', 'Insert text to be translated ...')
            ->setRequired();

        $form->addCheckbox('hyphen', 'Add hyphen to translation')
            ->setHtmlAttribute(
                'title',
                'Switch to translation that uses hyphen.
                 This allows for easier understanding of original meaning when dealing with ambiguous words.'
            );

        $form->addSubmit('send', 'Translate');

        $form->onSuccess[] = [$this, 'process'];

        return $form;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues('array');
        \assert(\is_array($values));

        $translationResult = $this->translatePigLatinService->translate($values['text'], $values['hyphen']);

        $this->presenter->template->translatedText = $translationResult;
    }
}
