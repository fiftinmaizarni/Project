<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AdminActivityModel;

class AuthController extends BaseController
{
    protected $adminModel;
    protected $activityModel;
    protected $email;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->adminModel = new AdminModel();
        $this->activityModel = new AdminActivityModel();
        $this->email = \Config\Services::email();
    }

    // ================= LOGIN =================
    public function login()
    {
        return view('admin/auth/login');
    }

    public function loginAction()
    {
        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));

        $admin = $this->adminModel->where('username', $username)->first();

        if (!$admin || !password_verify($password, $admin['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        session()->regenerate();
        session()->set([
            'admin_id' => $admin['id_admin'],
            'nama' => $admin['nama_admin'],
            'username' => $admin['username'],
            'role' => $admin['role'],
            'isLoggedInAdmin' => true
        ]);

        // ================= CATAT LOGIN =================
        $this->activityModel->log($admin['id_admin'], 'login', 'auth', null, 'Admin berhasil login');

        return redirect()->to('/admin/dashboard');
    }

    // ================= REGISTER =================
    public function register()
    {
        return view('admin/auth/register');
    }

    public function registerAction()
    {
        $rules = [
            'nama_admin' => 'required|min_length[3]',
            'username' => 'required|min_length[3]|is_unique[admin.username]',
            'email' => 'required|valid_email|is_unique[admin.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'role' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->adminModel->insert([
            'nama_admin' => trim($this->request->getPost('nama_admin')),
            'username' => trim($this->request->getPost('username')),
            'email' => trim($this->request->getPost('email')),
            'password' => trim($this->request->getPost('password')), // di-hash otomatis di model
            'role' => trim($this->request->getPost('role'))
        ]);

        return redirect()->to('/admin/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // ================= LOGOUT =================
    public function logout()
    {
        $adminId = session('admin_id');

        // ================= CATAT LOGOUT =================
        if ($adminId) {
            $this->activityModel->log($adminId, 'logout', 'auth', null, 'Admin logout');
        }

        session()->destroy();
        return redirect()->to('/admin/login');
    }

    // ================= FORGOT PASSWORD =================
    public function forgotPassword()
    {
        return view('admin/auth/forgot_password');
    }

    public function forgotPasswordAction()
    {
        $email = trim($this->request->getPost('email'));
        $admin = $this->adminModel->where('email', $email)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->adminModel->update($admin['id_admin'], [
            'reset_token' => $token,
            'reset_expires' => $expires
        ]);

        $link = site_url("admin/reset-password/$token");

        $this->email->setFrom('no-reply@example.com', 'Admin');
        $this->email->setTo($email);
        $this->email->setSubject('Reset Password Admin');
        $this->email->setMessage("Klik link ini untuk reset password: <a href='$link'>$link</a>");
        $this->email->setMailType('html');
        $this->email->send();

        return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    // ================= RESET PASSWORD =================
    public function resetPassword($token)
    {
        $admin = $this->adminModel->where('reset_token', $token)->first();

        if (!$admin || $admin['reset_expires'] < date('Y-m-d H:i:s')) {
            return redirect()->to('/admin/login')->with('error', 'Token tidak valid atau kadaluarsa.');
        }

        return view('admin/auth/reset_password', ['token' => $token]);
    }

    public function resetPasswordAction()
    {
        $token = trim($this->request->getPost('token'));
        $password = trim($this->request->getPost('password'));
        $password_confirm = trim($this->request->getPost('password_confirm'));

        if ($password !== $password_confirm) {
            return redirect()->back()->with('error', 'Password dan konfirmasi tidak sama.');
        }

        $admin = $this->adminModel->where('reset_token', $token)->first();
        if (!$admin) {
            return redirect()->to('/admin/login')->with('error', 'Token tidak valid.');
        }

        $this->adminModel->update($admin['id_admin'], [
            'password' => $password, // di-hash otomatis oleh model
            'reset_token' => null,
            'reset_expires' => null
        ]);

        return redirect()->to('/admin/login')->with('success', 'Password berhasil direset! Silakan login.');
    }
}
