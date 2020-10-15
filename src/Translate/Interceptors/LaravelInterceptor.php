<?php

namespace Twigger\Translate\Translate\Interceptors;

use Twigger\Translate\Translate\TranslationInterceptor;
use Twigger\Translate\Translate\Translator;

/**
 * Inject Laravel translations into the translation flow.
 */
class LaravelInterceptor extends TranslationInterceptor
{

    /**
     * The laravel translator
     *
     * @var \Illuminate\Translation\Translator
     */
    private $laravelTranslator;

    /**
     * @param array $config The configuration for the laravel translator
     * @param Translator $translator The underlying translation instance
     * @param \Illuminate\Translation\Translator $laravelTranslator The laravel translation instance
     */
    public function __construct(array $config, Translator $translator, \Illuminate\Translation\Translator $laravelTranslator)
    {
        parent::__construct($config, $translator);
        $this->laravelTranslator = $laravelTranslator;
    }

    /**
     * @inheritDoc
     */
    protected function canIntercept(string $line, string $to, string $from): bool
    {
        // TODO Check from language is alright
        return $this->laravelTranslator->has($line, [], $to);
    }

    /**
     * @inheritDoc
     */
    protected function get(string $line, string $to, string $from): string
    {
        return $this->laravelTranslator->get($line, [], $to);
    }

    /**
     * @inheritDoc
     */
    protected function save(string $line, string $to, string $from, string $translation): void
    {
        // No methods for setting translations for Laravel
    }
}
