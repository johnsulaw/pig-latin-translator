Pig Latin Translator in Nette
=================

Pig Latin is essentially a game of alterations played on the English language game. To form
the Pig Latin form of an English word the initial consonant sound is transposed to the end of
the word and an ay is affixed (Ex.:“banana“ would yield anana-bay). The purpose of the alte-
ration is to both obfuscate the encoding and to indicate for the intended recipient the enco-
ding as ‘Pig Latin‘. The reference to Latin is a deliberate misnomer, as it is simply a form
of jargon, used only for its English connotations as a ‘strange and foreign-sounding language‘.
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

- Web Project for Nette 3.1 requires PHP 8.0


Installation
------------

The best way to install Web Project is using Composer. If you don't have Composer yet,
download it following [the instructions](https://doc.nette.org/composer). Then use command:

	composer create-project nette/web-project path/to/install
	cd path/to/install


Make directories `temp/` and `log/` writable.


Web Server Setup
----------------

The simplest way to get started is to start the built-in PHP server in the root directory of your project:

	php -S localhost:8000 -t www

Then visit `http://localhost:8000` in your browser to see the welcome page.

For Apache or Nginx, setup a virtual host to point to the `www/` directory of the project and you
should be ready to go.

**It is CRITICAL that whole `app/`, `config/`, `log/` and `temp/` directories are not accessible directly
via a web browser. See [security warning](https://nette.org/security-warning).**
