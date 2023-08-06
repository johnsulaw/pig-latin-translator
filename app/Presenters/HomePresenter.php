<?php declare(strict_types=1);

namespace App\Presenters;

use App\Components\PigLatinFormControl\IPigLatinFormControlFactory;
use App\Components\PigLatinFormControl\PigLatinFormControl;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Presenter
{

    public function __construct(
        private IPigLatinFormControlFactory $pigLatinFormFactory,
    ) {
        parent::__construct();
    }

    protected function createComponentPigLatinForm(): PigLatinFormControl
    {
        return $this->pigLatinFormFactory->create();
    }

    public function process(Form $form, $data): void
    {
        $this->flashMessage('Kliknut!');

        $this->redirect('Home:');
    }

}
