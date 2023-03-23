<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

use App\Model\PigLatinTranslator;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Presenter
{
    public function createComponentTranslationForm(): Form
    {
        // Vytvoření nové instance formuláře
        $form = new Form();

        // Přidání textového pole pro vstup a nastavení jeho povinnosti
        $form->addText('input', 'Input text:')
            ->setRequired(true);

        // Přidání tlačítka pro odeslání formuláře
        $form->addSubmit('translate', 'Translate');

        // Při úspěšném odeslání formuláře se zavolá metoda translationFormSucceeded()
        $form->onSuccess[] = [$this, 'translationFormSucceeded'];

        // Vrácení instance formuláře
        return $form;
    }

    public function translationFormSucceeded(Form $form, array $values): void
    {
        // Získání vstupního textu z odeslaného formuláře
        $input = $values['input'];

        // Vytvoření instance třídy PigLatinTranslator pro překlad textu do Pig Latin
        $translator = new PigLatinTranslator();

        // Přeložení vstupního textu do Pig Latin
        $translation = $translator->translate($input);

        // Uložení přeloženého textu do šablony pro zobrazení v HTML
        $this->template->translation = $translation;
    }
}
