<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class pageAccess_filter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        $getRole = session()->get('role');
        // echo $arguments[0] . '==' . $getRole;
        if ($getRole == 1) {
            return;
        } elseif ($getRole = " ") {
            session()->setFlashdata('message', '<div class="alert alert-warning" role="alert">Login untuk melanjutkan</div>');
            return redirect()->to('/login');
        } else if ($arguments[0] != $getRole) {
            // echo $arguments;
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            return;
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
