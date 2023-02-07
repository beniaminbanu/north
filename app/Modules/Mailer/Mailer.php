<?php

namespace App\Modules\Mailer;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\Mail\Mailer as MailerContract;

/**
 * Class Mailer
 *
 * @package App\Modules\Mailer
 */
class Mailer
{
    /**
     * @var MailerContract
     */
    protected $mailer;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var ViewFactory
     */
    protected $viewFactory;

    /**
     * @var array
     */
    protected static $cached = [];

    /**
     * @var string
     */
    protected $viewNamespace = 'email_template';

    /**
     * @var string
     */
    protected $viewFileExtension = '.blade.php';

    /**
     * @var string
     */
    protected $viewDefaultLayout = 'layouts.email.default';

    /**
     * Mailer constructor.
     *
     * @param MailerContract $mailer
     * @param Filesystem     $filesystem
     * @param ViewFactory    $viewFactory
     */
    public function __construct(
        MailerContract $mailer,
        Filesystem $filesystem,
        ViewFactory $viewFactory
    ) {
        $this->mailer = $mailer;
        $this->filesystem = $filesystem;
        $this->viewFactory = $viewFactory;

        $this->viewFactory->addNamespace(
            $this->getViewNamespace(),
            $this->storagePath()
        );
    }

    /**
     * Get view namespace.
     *
     * @return string
     */
    public function getViewNamespace()
    {
        return $this->viewNamespace;
    }

    /**
     * Get view default layout.
     *
     * @return string
     */
    public function getViewDefaultLayout()
    {
        return $this->viewDefaultLayout;
    }

    /**
     * Get view default layout.
     *
     * @return string
     */
    public function getViewFileExtension()
    {
        return $this->viewFileExtension;
    }

    /**
     * Storage path.
     *
     * @return string
     */
    public function storagePath()
    {
        $path = getcwd() . $this->getViewNamespace();

        if (function_exists('storage_path') === true) {
            $path = storage_path($this->getViewNamespace());
        }

        if ($this->filesystem->isDirectory($path) === false) {
            $this->filesystem->makeDirectory($path, 0755, true);
        }

        return $path . '/';
    }

    /**
     * Get attributes.
     *
     * @param string $template
     * @return EmailTemplate
     */
    public function getAttributes($template)
    {
        if (empty(static::$cached[$template]) === true) {
            static::$cached[$template] = EmailTemplate::findByTemplate($template);
        }

        return static::$cached[$template];
    }

    /**
     * Get view.
     *
     * @param $template
     * @return string
     */
    public function getView($template)
    {
        $attributes = $this->getAttributes($template);

        $content = $attributes->content;

        $file = $this->storagePath() . md5($template) . $this->getViewFileExtension();
        $layout = $this->viewFactory->make($this->getViewDefaultLayout());

        if ($attributes->extend) {
            $layout->getFactory()->startSection('content', $content);
            $content = $layout->render();
        }

        if (
            $this->filesystem->exists($file) === false ||
            $attributes->updated_at->getTimestamp() > $this->filesystem->lastModified($file)
        ) {
            $this->filesystem->put($file, $content);
        }

        return $this->getViewNamespace() . '::' . md5($template);
    }

    /**
     * Send email.
     *
     * @param                 $template
     * @param array           $data
     * @param \Closure|string $closure
     *
     */
    public function send($template, $data, $closure)
    {
        $view = $this->getView($template);

        $attributes = $this->getAttributes($template);

        if ($attributes->from_address) {
            $this->mailer->alwaysFrom(
                $attributes->from_address,
                $attributes->from_name
            );
        }

        $this->mailer->send($view, $data, function ($m) use ($closure, $attributes) {
            $closure($m);
            $m->subject($m->getSubject() ?: $attributes->subject);
        });
    }

    /**
     * Call methods on mailer dynamically.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->mailer, $method], $parameters);
    }
}
