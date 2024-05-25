<?php

if (!function_exists('nav_active')) {

    /** Adds a CSS class to the element
     *
     * @param string $path Route name
     * @param string $class Class name CSS (example: active)
     *
     * @return string Return class name or empty
     */
    function nav_active($path, $class = 'active'): string
    {
        return (request()->route()->named($path) ? $class : '');
    }
}

if (!function_exists('alert')) {

    /**
     * @param string $msg
     * @param int|null $timer
     * @param string|bool $redirect
     * @param string $status
     *
     * @return array
     */
    function alert($msg, int $timer = null, $redirect = false, $status = null): array
    {
        switch ($status) {
            case 'info':
                $status = 'info';
                $title = '<b>Opps!</b> ';
                $icon = 'fa-exclamation';
                break;
            case 'warning':
                $status = 'warning';
                $title = '<b>Atenção!</b> ';
                $icon = 'fa-exclamation-triangle';
                break;
            case 'danger':
                $status = 'danger';
                $title = null;
                $icon = 'fa-ban';
                break;
            default:
                $status = 'success';
                $title = '<b>Tudo Certo.</b> ';
                $icon = 'fa-check';
                break;
        }
        return [
            'msg' => $title . $msg,
            'status' => $status,
            'icon' => $icon,
            'redirect' => $redirect,
            'timer' => $timer,
        ];
    }
}

if (!function_exists('db_error')) {
    function db_error($exception)
    {
        return alert(
            "<b>Erro inesperado!</b> {$exception}",
            false,
            false,
            'danger'
        );
    }
}

/**
 * @param $request
 *
 * @return string

function uploadImage_($file, $folder = null)
{
    $nameFile = uniqid(date('HisYmd')) . '.' . $file->extension();
    if (!file_exists(public_path("images/{$folder}"))) {
        mkdir(public_path("images/{$folder}"));
    }
    $upload = $file->move(public_path("images/{$folder}"), $nameFile);

    if (!$upload) {
        return response()->json([
            'trigger' => alert(
                'Erro ao enviar a imagem, tente novamente',
                4000,
                false, 'danger'
            ),
        ]);
    }
    return "{$folder}/{$nameFile}";
}
*/

if (!function_exists('thumb')) {

    /**
     * @param string|null $image
     * @param string|null $title
     * @param int $width
     * @param int|null $height
     * @param string|null $attributes
     *
     * @return string
     * @throws Exception
     */
    function thumb(?string $image, ?string $title, int $width, ?int $height, string $attributes = null): string
    {
        $title = htmlspecialchars($title);
        $publicPath = public_path('images');
        if (!file_exists($publicPath . '/' . $image) || $image == null) {
            $image = 'no_image.jpg';
        }
        $cropper = new \CoffeeCode\Cropper\Cropper($publicPath . '/cache', 100);
        $thumb = $cropper->make($publicPath . '/' . $image, $width, $height);
        $file = asset('images/cache/' . collect(explode('/', $thumb))->last());
        return '<img src="' . $file . '" title="' . $title . '" alt="' . $title . '" ' . $attributes . ' />';
    }
}
