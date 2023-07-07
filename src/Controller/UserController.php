<?php

namespace App\Controller;

use App\Manager\FormManager\FormChangePassword;
use App\Manager\UserManager;
use App\SessionBlog\SessionBlog;
use Core\Controller\Controller;
use Core\Http\Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class UserController extends Controller
{


    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showAllUser(): void
    {
        if (UserManager::userIsAdmin() === true) {
            $data = [
                'users' => (new UserManager())->getAllUsers(),
                'notificationUserManagement' => \App\Manager\Notification::notificationUserManagement()
            ];
            $this->render('management-user.twig', $data);
            return;
        }

        $this->redirect('/403');

    }


    /**
     * @param int $id
     * @return void
     */
    public function setAdmin(int $id): void
    {
        (new UserManager())->setUserAdmin($id);
        $this->redirect('/user-management');

    }


    /**
     * @param int $id
     * @return void
     */
    public function setUser(int $id): void
    {
        (new UserManager())->setUserUser($id);
        $this->redirect('/user-management');

    }


    /**
     * @param int $id
     * @return void
     */
    public function doDeleteUser(int $id): void
    {
        (new UserManager())->deleteUser($id);
        $this->redirect('/user-management');

    }


    /**
     * @param string $token
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function setValid(string $token): void
    {
        $user = (new UserManager())->getUserByToken($token);

        if (empty($user) === true) {
            $data = [];
            $data['error'] = 'Unknown token';
            $this->render('connection.twig', $data);
            return;
        }

        if ($user->getValidation() === 'valid') {
            $data = [];
            $data['error'] = 'Your account is already valid';
            $this->render('connection.twig', $data);
            return;
        }

        $exp = $user->getExpirationDate();

        if ($exp > strtotime('now')) {
            (new UserManager())->setUserValid($token);
            $data = [];
            $data['error'] = 'Your account has been successfully validated';
            $this->render('connection.twig', $data);
            return;
        }

        if ($exp < strtotime('now')) {
            (new UserManager())->deleteUserByToken($token);
            $data = [];
            $data['error'] = 'The link has expired. You have to recreate a registration';
            $this->render('connection.twig', $data);
        }

    }


    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showProfile(): void
    {
        $sessionEmail = SessionBlog::get('email');
        $userSession = (new UserManager())->getUserInfo($sessionEmail);

        if (UserManager::userIsConnected() === true) {
            $data = [];
            $data['userSession'] = $userSession;
            $this->render('profile.twig', $data);
            return;
        }

        $this->redirect('/403');

    }


    /**
     * @param int $id
     * @return void
     */
    public function changePassword(int $id): void
    {
        $request = new Request();
        $password = new FormChangePassword();
        $errors = $password->isValid($request->getPost());
        $sessionEmail = SessionBlog::get('email');
        $userSession = (new UserManager())->getUserInfo($sessionEmail);

        if (empty($errors) === false) {
            $data = [
                'errors' => $errors,
                'userSession' => $userSession,
            ];
            $this->render('profile.twig', $data);
            return;
        }

        (new UserManager())->updateNewPassword($request->getPost(), $id);

        $data = [
            'errors' => $errors,
            'userSession' => $userSession,
        ];
        $this->render('profile.twig', $data);

    }


}
