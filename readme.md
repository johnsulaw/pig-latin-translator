Pig Latin Translator in Nette
=================
Assignment
------------
Pig Latin is essentially a game of alterations played on the English language game. To form
the Pig Latin form of an English word the initial consonant sound is transposed to the end of
the word and an ay is affixed (Ex.:“banana“ would yield anana-bay). The purpose of the alteration
is to both obfuscate the encoding and to indicate for the intended recipient the encoding as ‘Pig Latin‘.
The reference to Latin is a deliberate misnomer, as it is simply a form of jargon, 
used only for its English connotations as a ‘strange and foreign-sounding language‘.
The origins of Pig Latin are unknown.
The usual rules for changing standard English into Pig Latin are as follows:

In words that begin with **consonant** sounds, the initial consonant or consonant cluster is
moved to the end of the word, and “ay“ is added, as in the following examples:

- beast → east-bay
- dough → ough-day
- happy → appy-hay
- question → estion-quay
- star → ar-stay
- three → ee-thray

In words that begin with **vowel** sounds or silent consonants, the syllable “ay“ is added to the
end of the word. In some dialects, to aid in pronunciation, an extra consonant is added to the
beginning of the suffix; for instance,eagle could yield eagle‘yay, eagle‘way, or eagle‘hay.
Transcription varies. A hyphen or apostrophe is sometimes used to facilitate translation back
into English. Ayspray, for instance, is ambiguous, but ay-spray means “spray“ whereas ays-pray
means “prays.

Requirements
------------
- Runs with Nette 3.1 and PHP 8.0


Installation
----------------
Pull the repository. Run `composer install` in the projects root directory.
For running the project on localhost the simplest way is to start the built-in PHP server in the root directory of 
the project by executing:

	php -S localhost:8000 -t www

Then visit `http://localhost:8000` to interact with the input form.

Codesniffer, PHPStan and Unit tests
----------------
The project contains Codesniffer and PHPStan utilities for better code writing. \
Codesniffer is set to `PSR2` standard. Automatic code fixer is also present. \
PHPStan strictness is set to maximal level. 

Scripts for running this services are located in the `/bin` folder in project's root. You can run the utilities by running

	php bin/run_cs
    php bin/fix_cs
    php bin/run_phpstan

from the project's root directory.

PHPUnit tests are also present int the `tests` directory. These can be run by executing
    
    vendor/bin/phpunit tests/TranslatePigLatin/PigLatinTranslatorTest.php

from the projects root directory.