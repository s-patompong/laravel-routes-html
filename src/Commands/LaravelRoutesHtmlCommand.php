<?php

namespace SPatompong\LaravelRoutesHtml\Commands;

use Illuminate\Console\Command;

class LaravelRoutesHtmlCommand extends Command
{
    public $signature = 'laravel-routes-html';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
