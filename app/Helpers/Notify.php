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
    public static function success($msg): void
    {
        $title = __('messages.success') . "!";
        flash()->addFlash('success', $msg, $title);
    }

    /**
     * Display a warning notification.
     *
     * @param string $title The notification title.
     * @param string $message The notification message.
     * @return void
     */
    public static function warning($msg)
    {
        $title = __('messages.alert') . "!";
        flash()->addFlash('success', $msg, $title);
    }

    /**
     * Display an error notification.
     *
     * @param string $title The notification title.
     * @param string $message The notification message.
     * @return void
     */
    public static function error($message)
    {
        $title = __('messages.error') . "!";
        flash()->addFlash('success', $msg, $title);
    }
}
