<?php


namespace TestProject\Controller;

use TestProject\Base\BaseController;

class Admin extends BaseController
{
    public function login()
    {
        if ($this->isLogged())
            header('Location: ' . ROOT_URL . '?p=blog&a=all');

        if (isset($_POST['email'], $_POST['password']))
        {
            $this->getModel('Admin');
            $this->oModel = new \TestProject\Model\Admin;

            $sHashPassword =  $this->oModel->login($_POST['email']);

            if (($_POST['password']=== $sHashPassword))
            {
                $_SESSION['is_logged'] = 1; // Admin is logged now
                header('Location: ' . ROOT_URL . '?p=blog&a=all');
                exit;
            }
            else
            {
                $this->sErrMsg = 'Incorrect Login!';
            }
        }

        $this->getView('login');
    }

    public function logout()
    {
        if (!$this->isLogged())
            exit;

        // clear sessionn
        if (!empty($_SESSION))
        {
            $_SESSION = array();
            session_unset();
            session_destroy();
        }

        // Redirect to the homepage
        header('Location: ' . ROOT_URL);
        exit;
    }
}