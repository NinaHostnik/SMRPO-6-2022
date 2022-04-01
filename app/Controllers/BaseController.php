<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();



    }

    protected function render_page($view,$data)
    {
        echo view('templates/header', $data);
        echo view($view, $data);
        echo view('templates/footer', $data);

    }

    protected function setUserSession($user,$roles)
    {
        $data = [
            'id' => $user['id'],
            'password' => $user['password'],
            'username' => $user['username'],
            'permissions' => $user['permissions'],
            'lastLogin' => $user['lastLogin'],
            'pas_change' => $user['pas_change'],
            'ime' => $user['ime'],
            'priimek' => $user['priimek'],
            'mail' => $user['mail'],
        ];

        foreach ($roles as $role):
            $data['roles'] = array($role['project'] => $role['role']);
        endforeach;

        var_dump($data);
        session()->set($data);
        return true;
    }

    protected function setUserSessionRoles($roles){

        #var_dump($roles);
        $data = [];
        foreach ($roles as $role):
            #session()->set(strval($role['project']), $role['role']);
            $data['roles'] = array($role['project'] => $role['role']);
        endforeach;

        return true;
    }
}
