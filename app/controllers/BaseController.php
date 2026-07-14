<?php


namespace App\Controllers;
/**
 * BootIgniter BaseController
 *
 * Thin base controller â€” extends CI4's Controller.
 * Wires up $this->db and $this->session for all child controllers.
 * Also preloads the Setting and User models that are always needed.
 *
 * @package     BootIgniter
 * @author      AZinkey
 * @Version     2.0
 */

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Setting;
use App\Models\User;

class BaseController extends \CodeIgniter\Controller
{
    /** @var \CodeIgniter\Database\BaseConnection */
    protected $db;

    /** @var \CodeIgniter\Session\Session */
    protected $session;

    /** @var Setting */
    protected $setting;

    /** @var User */
    protected $user;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);

        $this->db      = db_connect();
        $this->session = service('session');

        // Always-available models â€” same as old autoload['model'] = ['az', 'user', 'setting']
        $this->setting = new Setting();
        $this->user    = new User();
    }
}
