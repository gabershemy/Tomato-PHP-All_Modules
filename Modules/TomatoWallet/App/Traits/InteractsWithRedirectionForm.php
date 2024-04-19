<?php

namespace Modules\TomatoWallet\App\Traits;

use Modules\TomatoWallet\App\RedirectionForm;

trait InteractsWithRedirectionForm
{
    /**
     * Set view path of redirection form.
     *
     * @param string $path
     *
     * @return void
     */
    public static function setRedirectionFormViewPath(string $path)
    {
        RedirectionForm::setViewPath($path);
    }

    /**
     * Retrieve default view path of redirection form.
     *
     * @return void
     */
    public static function getRedirectionFormDefaultViewPath() : string
    {
        return RedirectionForm::getDefaultViewPath();
    }

    /**
     * Retrieve current view path of redirection form.
     *
     * @return void
     */
    public static function getRedirectionFormViewPath() : string
    {
        return RedirectionForm::getViewPath();
    }

    /**
     * Set view renderer
     *
     * @param callable $renderer
     */
    public static function setRedirectionFormViewRenderer(callable $renderer)
    {
        RedirectionForm::setViewRenderer($renderer);
    }
}
