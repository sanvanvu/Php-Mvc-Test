<?php

namespace TestProject\Controller;

use TestProject\Base\BaseController;
use TestProject\Middleware\GetData;

class Blog extends BaseController
{
    const MAX_POSTS = 5;
    /**
     * @var \TestProject\Model\Blog
     */
    protected  $oModel;
    private $_iId;

    public function __construct()
    {
        /** Get the Model class in all the controller class **/
        $this->getModel('Blog');
        $this->oModel = new \TestProject\Model\Blog();
        /** Get the Post ID in the constructor in order to avoid the duplication of the same code **/
        $this->_iId = (int) (!empty($_GET['id']) ? $_GET['id'] : 0);
        parent::__construct();

    }

    /***** Front end *****/
    // Homepage
    public function index()
    {
        $this->oPosts = $this->oModel->get(0, self::MAX_POSTS); // Get only the latest X posts

        $this->getView('index');
    }

    public function post()
    {
        $this->oPost = $this->oModel->getById($this->_iId); // Get the data of the post

        $this->getView('post');
    }

    public function notFound()
    {
        $this->getView('not_found');
    }


    /***** For Admin (Back end) *****/
    public function all()
    {
        if (!$this->isLogged()) exit;

        $this->oPosts = $this->oModel->getAll();

        $this->getView('index');
    }


    public function add()
    {
        if (!$this->isLogged()) exit;

        if (!empty($_POST['add_submit']))
        {
            if (isset($_POST['title'], $_POST['content']) && mb_strlen($_POST['title']) <= 50) // Allow a maximum of 50 characters
            {
                $aData = array('title' => $_POST['title'], 'content' => $_POST['content']);

                if ($this->oModel->add($aData))
                    $this->sSuccMsg = 'Hurray!! The post has been added.';
                else
                    $this->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
            }
            else
            {
                $this->sErrMsg = 'All fields are required and the title cannot exceed 50 characters.';
            }
        }

        $this->getView('add_post');
    }

    public function edit()
    {
        if (!$this->isLogged()) exit;

        if (!empty($_POST['edit_submit']))
        {
            if (isset($_POST['title'], $_POST['content']))
            {
                $aData = array('id' => $this->_iId, 'title' => $_POST['title'], 'content' => $_POST['content']);

                if ($this->oModel->update($aData))
                    $this->sSuccMsg = 'Hurray! The post has been updated.';
                else
                    $this->sErrMsg = ' An error has occurred! Please try again later';
            }
            else
            {
                $this->sErrMsg = 'All fields are required.';
            }
        }

        /* Get the data of the post */
        $this->oPost = $this->oModel->getById($this->_iId);

        $this->getView('edit_post');
    }

    public function delete()
    {
        if (!$this->isLogged()) exit;

        if (!empty($_POST['delete']) && $this->oModel->delete($this->_iId))
            header('Location: ' . ROOT_URL);
        else
            exit('Post cannot be deleted.');
    }


}