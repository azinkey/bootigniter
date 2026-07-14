<?php


namespace App\Libraries;
/**
 * BootIgniter
 *
 * @package     BootIgniter
 * @author      AZinkey
 * @copyright   Copyright (c) 2015 - 2026, AZinkey LLC.
 * @license     MIT License
 * @link        http://bootigniter.org
 * @Version     2.0
 */

/**
 * AZ â€” BootIgniter's core static facade.
 *
 * Provides layout/block/redirect/flash/pagination API.
 * Same public API as CI3 version â€” only internals updated for CI4.
 *
 * Usage:
 *   AZ::layout('left-content', $vars)
 *   AZ::block('dashboard/index', $vars)
 *   AZ::redirectSuccess('admin/dashboard', 'Saved!')
 *   AZ::setting('site_name')
 */
class AZ
{
    /**
     * Determine if current request is an admin-side request.
     */
    protected static function isAdmin(): bool
    {
        $segment = service('uri')->getSegment(1);
        return ($segment === 'admin' || $segment === 'administrator');
    }

    // -----------------------------------------------------------------------
    // Layout & Block Rendering
    // -----------------------------------------------------------------------

    /**
     * Load a full page layout.
     *
     * @param string $name  Layout name (e.g. 'left-content', 'content')
     * @param array  $vars  Variables to pass to the layout view
     * @param string $theme Front-end theme name (default: 'default')
     */
    public static function layout(string $name, array $vars = [], string $theme = 'default'): void
    {
        $path = self::isAdmin()
            ? 'admin/layouts/' . $name
            : 'front/' . $theme . '/layouts/' . $name;

        echo view($path, $vars);
    }

    /**
     * Load a view block (partial view).
     *
     * @param string $name  Block name (e.g. 'dashboard/index', 'navigations')
     * @param array  $vars  Variables to pass to the block
     * @param string $theme Front-end theme name (default: 'default')
     */
    public static function block(string $name = 'default', array $vars = [], string $theme = 'default'): void
    {
        if (empty($name)) {
            throw new \RuntimeException('AZ::block() â€” block name is required.');
        }

        $path = self::isAdmin()
            ? 'admin/blocks/' . $name
            : 'front/' . $theme . '/blocks/' . $name;

        echo view($path, $vars);
    }

    /**
     * Load the page <head> block.
     */
    public static function head(string $name = 'head', string $theme = 'default', array $vars = []): void
    {
        $path = self::isAdmin()
            ? 'admin/layouts/' . $name
            : 'front/' . $theme . '/layouts/' . $name;

        echo view($path, $vars);
    }

    /**
     * Load the page <header> block.
     */
    public static function header(string $name = 'header', string $theme = 'default', array $vars = []): void
    {
        $path = self::isAdmin()
            ? 'admin/layouts/' . $name
            : 'front/' . $theme . '/layouts/' . $name;

        echo view($path, $vars);
    }

    /**
     * Load the page footer block.
     */
    public static function footer(string $name = 'footer', string $theme = 'default', array $vars = []): void
    {
        $path = self::isAdmin()
            ? 'admin/layouts/' . $name
            : 'front/' . $theme . '/layouts/' . $name;

        echo view($path, $vars);
    }

    // -----------------------------------------------------------------------
    // Model & Helper Loading
    // -----------------------------------------------------------------------

    /**
     * Load a model and attach it to CI's service container.
     * Same usage as old AZ::model('user') â€” model becomes $CI->user
     *
     * @param string $model      Model class name (e.g. 'user', 'content')
     * @param string|null $alias Optional alias for the model property
     */
    public static function model(string $model, ?string $alias = null): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
        if (isset($trace[1]['object'])) {
            $caller = $trace[1]['object'];
            $modelClass = '\\App\\Models\\' . ucfirst($model);
            $aliasName = $alias ?? strtolower($model);
            if (class_exists($modelClass)) {
                $caller->$aliasName = new $modelClass();
            }
        }
    }

    /**
     * Load a helper file.
     */
    public static function helper(string $name): void
    {
        helper($name);
    }

    // -----------------------------------------------------------------------
    // Redirect & Flash Messages
    // -----------------------------------------------------------------------

    /**
     * Redirect with a flash message.
     */
    public static function redirectMSG(string $uri, ?string $flashValue = null, string $flashKey = 'flash_info'): void
    {
        $session = service('session');
        if (!is_null($flashValue) && !empty($flashValue)) {
            $session->setFlashdata($flashKey, $flashValue);
        }
        if (!empty($uri)) {
            header('Location: ' . site_url($uri));
            exit;
        }
    }

    public static function redirectWarning(string $uri, ?string $flashValue = null): void
    {
        self::redirectMSG($uri, $flashValue, 'flash_warning');
    }

    public static function redirectError(string $uri, ?string $flashValue = null): void
    {
        self::redirectMSG($uri, $flashValue, 'flash_error');
    }

    public static function redirectSuccess(string $uri, ?string $flashValue = null): void
    {
        self::redirectMSG($uri, $flashValue, 'flash_success');
    }

    /**
     * Redirect, preserving any existing flash messages.
     */
    public static function redirect(string $uri): void
    {
        header('Location: ' . site_url($uri));
        exit;
    }

    // -----------------------------------------------------------------------
    // Flash Message Display
    // -----------------------------------------------------------------------

    public static function flashMSG(string $msg, string $flashKey = 'flash_info'): bool
    {
        if (empty($msg)) {
            return false;
        }
        service('session')->setFlashdata($flashKey, $msg);
        return true;
    }

    public static function showFlashMSG(string $flashKey = 'flash_info', string $class = 'alert-info'): ?string
    {
        $msg = service('session')->getFlashdata($flashKey);
        if (!empty($msg)) {
            return '<div class="alert ' . $class . ' alert-dismissible fade show" role="alert">'
                . $msg
                . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                . '</div>';
        }
        return null;
    }

    public static function showFlashError(string $flashKey = 'flash_error'): ?string
    {
        return self::showFlashMSG($flashKey, 'alert-danger');
    }

    public static function showFlashWarning(string $flashKey = 'flash_warning'): ?string
    {
        return self::showFlashMSG($flashKey, 'alert-warning');
    }

    public static function showFlashSuccess(string $flashKey = 'flash_success'): ?string
    {
        return self::showFlashMSG($flashKey, 'alert-success');
    }

    // -----------------------------------------------------------------------
    // Settings
    // -----------------------------------------------------------------------

    /**
     * Get a setting value by key.
     * Reads from the settings table via the Setting model.
     */
    public static function setting(string $key): mixed
    {
        static $settingModel = null;
        if ($settingModel === null) {
            $settingModel = new \Setting();
        }
        return $settingModel->getSetting($key);
    }

    // -----------------------------------------------------------------------
    // Pagination
    // -----------------------------------------------------------------------

    /**
     * Generate Bootstrap-styled pagination links.
     * Same signature as the old AZ::pagination() call.
     *
     * @param string $baseUrl     Route base URL
     * @param int    $uriSegment  Which URI segment holds the offset
     * @param int    $perPage     Items per page
     * @param int    $totalRows   Total number of records
     * @param bool   $bootstrap   Whether to use Bootstrap styling
     * @param bool   $queryString Use query string pagination instead of segments
     */
    public static function pagination(
        string $baseUrl,
        int $uriSegment,
        int $perPage,
        int $totalRows,
        bool $bootstrap = true,
        bool $queryString = false
    ): string {
        // CI4 Pager service
        $pager = service('pager');
        $currentPage = (int) (service('uri')->getSegment($uriSegment) ?: 1);
        $offset       = ($currentPage - 1) * $perPage;

        if ($totalRows === 0 || $perPage === 0) {
            return '';
        }

        $totalPages = (int) ceil($totalRows / $perPage);

        if ($totalPages <= 1) {
            return '';
        }

        // Build Bootstrap 5 pagination HTML
        $html  = '<ul class="pagination pagination-sm float-end">';

        for ($i = 1; $i <= $totalPages; $i++) {
            $active   = ($i === $currentPage) ? ' active' : '';
            $pageUrl  = $queryString
                ? site_url($baseUrl) . '?per_page=' . (($i - 1) * $perPage)
                : site_url($baseUrl . '/' . (($i - 1) * $perPage));

            $html .= '<li class="page-item' . $active . '">'
                . '<a class="page-link" href="' . $pageUrl . '">' . $i . '</a>'
                . '</li>';
        }

        $html .= '</ul>';
        return $html;
    }

    // -----------------------------------------------------------------------
    // URL Helper
    // -----------------------------------------------------------------------

    /**
     * Echo a site URL.
     */
    public static function url(string $uri = ''): void
    {
        echo site_url($uri);
    }
}
