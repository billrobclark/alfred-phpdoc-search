# PHP Documentation Search Workflow for Alfred

![Build Status](https://travis-ci.org/billrobclark/alfred-phpdoc-search.svg?branch=master)

http://www.packal.org/workflow/php-docs

Would you like to use [Alfred](https://www.alfredapp.com/) for MacOS to quickly search the PHP documentation?

Well, this Workflow will allow just that, super easy to install and start using. Guaranteed it will improve
your productivity as you can just use your hotkey for [Alfred](https://www.alfredapp.com/) and quick look at the function you're wanting to check out.
You can also open the php.net documenation in your default web browser.

![Screenshot](workflow-action.gif)

Inspired by [Laravel Docs Search](https://github.com/tillkruss/alfred-laravel-docs) by Till Krüss powered by Algolia.

## Installation

1. [Download the latest version](https://github.com/billrobclark/alfred-phpdoc-search/releases/download/v1.1.0/PHP.Docs.alfredworkflow)
2. Install the workflow by double-clicking and opening the `.alfredworkflow` file that you just downloaded.
3. If you want you can add the workflow to a category (not required), then click "Import" to finish importing.
4. Now the workflow will be listed there on the left of your Alfred Workflows preferences.

Note: If you'd like to change the default language for the PHP documentation you can.
Just go to your Alfred preferences -> workflows -> PHP Docs -> then on the right you'll see some options.
Click on the environment variables option [~] and edit the language to be the
language desired (e.g 'en' => english, 'es' => spanish) and click save.
Your PHP docs will now open up in the your set language.

## Usage

Just type `php` with a space and whatever you're trying to search on php.net and results display instantly.

```
php <query>
php array_unique
```

There are two ways to see the actual php.net documentation page.

1. Press `⌘Y` to quick look the result.
2. Press `<enter>` to open the PHP documentation page in your default web browser.
