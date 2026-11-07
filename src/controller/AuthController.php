<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/UserModel.php';

class AuthController extends Controller
{
    private UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function registerForm(): void
    {
        if (Auth::check()) {
            header('Location: /account');
            exit;
        }

        $this->view('register', [
            'pageTitle' => 'Регистрация',
            'errors' => [],
            'old' => [],
        ]);
    }

    public function register(): void
    {
        $name = trim(is_string($_POST['name'] ?? null) ? $_POST['name'] : '');
        $email = strtolower(trim(is_string($_POST['email'] ?? null) ? $_POST['email'] : ''));
        $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
        $confirm = is_string($_POST['password_confirmation'] ?? null) ? $_POST['password_confirmation'] : '';

        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Введите имя.';
        } elseif (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
            $errors['name'] = 'Имя должно содержать от 2 до 100 символов.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Введите корректный адрес электронной почты.';
        } elseif (strlen($email) > 190) {
            $errors['email'] = 'Адрес электронной почты слишком длинный.';
        } elseif ($this->users->findByEmail($email)) {
            $errors['email'] = 'Аккаунт с таким адресом уже существует.';
        }

        if (strlen($password) < 8) {
            $errors['password'] = 'Пароль должен содержать минимум 8 символов.';
        } elseif (strlen($password) > 72) {
            $errors['password'] = 'Пароль не должен превышать 72 байта.';
        }

        if ($password !== $confirm) {
            $errors['password_confirmation'] = 'Пароли не совпадают.';
        }

        if ($errors !== []) {
            $this->view('register', [
                'pageTitle' => 'Регистрация',
                'errors' => $errors,
                'old' => ['name' => $name, 'email' => $email],
            ]);
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $userId = $this->users->create($name, $email, $passwordHash);
        } catch (PDOException $error) {
            if ($error->getCode() === '23000') {
                $this->view('register', [
                    'pageTitle' => 'Регистрация',
                    'errors' => ['email' => 'Аккаунт с таким адресом уже существует.'],
                    'old' => ['name' => $name, 'email' => $email],
                ]);
                return;
            }

            throw $error;
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'role' => 'user',
        ];

        header('Location: /account');
        exit;
    }

    public function loginForm(): void
    {
        if (Auth::check()) {
            header('Location: /account');
            exit;
        }

        $this->view('login', [
            'pageTitle' => 'Вход',
            'error' => '',
            'email' => '',
        ]);
    }

    public function login(): void
    {
        $email = strtolower(trim(is_string($_POST['email'] ?? null) ? $_POST['email'] : ''));
        $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
            $this->view('login', [
                'pageTitle' => 'Вход',
                'error' => 'Проверьте адрес электронной почты и пароль.',
                'email' => $email,
            ]);
            return;
        }

        $user = $this->users->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->view('login', [
                'pageTitle' => 'Вход',
                'error' => 'Неверный адрес электронной почты или пароль.',
                'email' => $email,
            ]);
            return;
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        header('Location: /account');
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
        header('Location: /');
        exit;
    }
}
