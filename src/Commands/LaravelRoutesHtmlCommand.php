<?php

namespace SPatompong\LaravelRoutesHtml\Commands;

use Illuminate\Console\Command;

class LaravelRoutesHtmlCommand extends Command
{
    public $signature = 'routes:html';

    public $description = 'Generate routes as HTML and open it in the browser.';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
