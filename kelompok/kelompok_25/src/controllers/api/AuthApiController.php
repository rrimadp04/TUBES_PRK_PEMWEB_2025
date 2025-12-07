<?php

/**
 * Auth API Controller
 */

require_once ROOT_PATH . '/core/Controller.php';
require_once ROOT_PATH . '/core/Response.php';
require_once ROOT_PATH . '/core/Auth.php';
require_once ROOT_PATH . '/models/User.php';

class AuthApiController extends Controller
{
    /**
     * Login via API
     */
    public function login()
    {
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        // Validate input
        if (empty($input['email']) || empty($input['password'])) {
            Response::error('Email dan password wajib diisi.', [], 400);
        }

        // Attempt login
        if (!Auth::attempt($input['email'], $input['password'])) {
            Response::error('Email atau password salah.', [], 401);
        }

        // Update last login
        $userModel = new User();
        $userModel->updateLastLogin(Auth::id());

        Response::success('Login berhasil.', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Register via API
     */
    public function register()
    {
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        // Validate input
        $validator = Validator::make($input, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        if (!$validator->validate()) {
            Response::validationError($validator->errors());
        }

        try {
            $validated = $validator->validated();

            // Create user
            $userModel = new User();
            $userId = $userModel->create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'is_active' => true
            ]);

            // Assign default role
            $roleModel = new Role();
            $defaultRole = $roleModel->findByCode('staff');
            
            if ($defaultRole) {
                $userModel->assignRole($userId, $defaultRole['id'], true);
            }

            Response::created('Registrasi berhasil.', [
                'user_id' => $userId
            ]);

        } catch (Exception $e) {
            Response::error('Terjadi kesalahan saat registrasi.', [], 500);
        }
    }

    /**
     * Logout via API
     */
    public function logout()
    {
        Auth::logout();
        Response::success('Logout berhasil.');
    }

    /**
     * Get current user
     */
    public function me()
    {
        if (!Auth::check()) {
            Response::unauthorized('Anda belum login.');
        }

        Response::success('User data retrieved.', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Check authentication
     */
    public function check()
    {
        Response::success('Check authentication.', [
            'authenticated' => Auth::check(),
            'user' => Auth::user()
        ]);
    }
}
