<?php

/*

Não vai mais ser utilizado, vammos usar as nots do laravel assim:
    Session::flash('success', 'msg');
    Session::flash('warning', 'msg');
    Session::flash('error', 'MUITO FODA');
    Session::flash('error', 'MUITO FODA');

    $title = 'Título da mensagem: ';
    $message = 'Mensagem de sucesso!';
    Session::flash('success', $title . $message);


*/

namespace App\Helpers;

/**
 * Class Notify
 *
 * Provides methods to display Toastr notifications with different message types.
 *
 * @author Guilherme Kulik
 */
class Notify
{
    /**
     * Display a success notification.
     *
     * @param string $title The notification title.
     * @param string $message The notification message.
     * @return void
     */
    public static function success($title, $message)
    {
        toastr()->success($message, $title ?: __('messages.words.success'), [
            'iconClass' => 'toast-success-icon',
            'backgroundClass' => 'toast-success-background',
            'timeOut' => '0',
        ]);
    }

    /**
     * Display a warning notification.
     *
     * @param string $title The notification title.
     * @param string $message The notification message.
     * @return void
     */
    public static function warning($title, $message)
    {
        toastr()->warning($message, $title ?: __('messages.words.warning'), [
            'iconClass' => 'toast-warning-icon',
            'backgroundClass' => 'toast-warning-background'
        ]);
    }

    /**
     * Display an error notification.
     *
     * @param string $title The notification title.
     * @param string $message The notification message.
     * @return void
     */
    public static function error($title, $message)
    {
        toastr()->error($message, $title ?: __('messages.words.error'), [
            'iconClass' => 'toast-error-icon',
            'backgroundClass' => 'toast-error-background'
        ]);
    }
}
