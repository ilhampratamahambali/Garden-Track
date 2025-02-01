<?php
namespace App\Controllers;
use App\Models\UsersModel;
use Google_Client;

class Pengguna extends BaseController
{
    private $googleClient;
    protected $users;

    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->users = new UsersModel();

        $this->googleClient->setClientId(env('Clientid'));
        $this->googleClient->setClientSecret(env('ClientSecret'));
        $this->googleClient->setRedirectUri('http://localhost:8080/login/proses');
        $this->googleClient->setRedirectUri('http://localhost:8080/register/proses');
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
    }

// --=========================================|| LOGIN ||================================================--

    // LOGIN GOOGLE
    public function index_login(){
        if (session()->get('access_token')) {
            $this->googleClient->revokeToken(session()->get('access_token'));
            session()->remove('access_token');
        }
        
        $data['link'] = $this->googleClient->createAuthUrl();
        return view('login_page', $data);
    }

    public function proses_login()
    {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getvar('code'));
        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token['access_token']);
            session()->set('access_token', $token['access_token']);
    
            $googleService = new \Google_Service_Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();
    
            // Simpan data ke dalam array sesi
            $row = [
                'id_user'     => $data['id'],
                'nama_users'  => $data['name'],
                'email'       => $data['email'],
                'profile'     => $data['picture'],
                'logged_in'   => true,
            ];
            session()->set($row);
    
            $userExists = $this->users->where('id_user', $data['id'])->first();
            if (!$userExists) {
                $this->users->save($row);
            }
            
            return redirect()->to('/user_page');
        }
        return redirect()->to('/login')->with('error', 'Autentikasi gagal.');
    }

    //LOGIN BIASA
    public function auth(){
        // Validasi input
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
    
        if(!$this->validate($rules)){
            session()->setFlashdata('errors', $this->validator->getErrors());
            return view("login_page");
        }
    
        // Ambil inputan
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        //cek email
        $user = $this->users->get_user_email($email);
    
        // Jika email tidak ditemukan
        if (!$user) {
            session()->setFlashdata('error', 'Email tidak ditemukan');
            return redirect()->to('/login')->withInput();
        }
    
        // Verifikasi password
        if (!password_verify($password, $user->password)) {
            session()->setFlashdata('error', 'Password salah');
            return redirect()->to('/login')->withInput();
        }
    
        // Set session
        session()->set([
            'id_user' => $user->id_user,
            'email' => $user->email,
            'logged_in' => true
        ]);
        
        // Tampilkan pesan sukses
        session()->setFlashdata('success', 'Login berhasil!');
        return redirect()->to('/user_page');
    }

    // -----------------------------------++USER_PAGE++----------------------------------------
    public function home()
    {
        // Validasi apakah pengguna telah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data dari sesi untuk ditampilkan di view
        $data = [
            'nama_users' => session()->get('nama_users'),
            'profile'    => session()->get('profile'),
            'email'      => session()->get('email'),
        ];

        // Tampilkan halaman user dengan data pengguna
        return view('/user_page', $data);
    }

// --=========================================|| REGISTER ||================================================--

    // REGISTER DISINI
    public function index_regis()
    {
        $data['link']=$this->googleClient->CreateAuthUrl();
        return view('register_page', $data);
    }

    //REGIS GOOGLE
    public function proses_regis()
    {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getvar('code'));
        if(!isset($token['error'])){
            $this->googleClient->setAccessToken($token['access_token']);
            $googleService = new \Google_Service_Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();
            $row=[
                'id_user'=>$data['id'],
                'nama_users'=>$data['name'],
                'email'=>$data['email'],
                'profile'=>$data['picture'],
            ];
            $this->users->save($row);

            session()->set($row);
            session()->set('logged_in', true);
            session()->setFlashdata('success', 'Login berhasil!');
            return redirect()->to('user_page');
        }   
    }

    //REGIS BIASA
    public function regis_auth(){
        // Aturan validasi untuk form registrasi
        $rules = [
            'nama_users' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]', 
            'password' => 'required',
            'confirm_password' => 'required|matches[password]',
        ];

        // Pesan error khusus email
        $messages = [
            'email' => [
                'is_unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.',
            ],
        ];

        // Validasi inputan
        if (!$this->validate($rules, $messages)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to('/register');
        }

        // Mendapatkan data input dari form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Jika password dan confirm password tidak cocok
        if ($password !== $confirmPassword) {
            session()->setFlashdata('error', ['Password dan konfirmasi password tidak cocok.']);
            return redirect()->to('/register')->withInput()->with('password', ''); 
        }

        // Validasi email)
        if (strpos($email, '@') === false) {
            session()->setFlashdata('error', ['Email harus mengandung karakter "@"']);
            return redirect()->to('/register');
        }

        // Jika semua validasi lolos, maka kita lakukan proses penyimpanan user
        $passwordHash = password_hash($password, PASSWORD_BCRYPT); 
        // membuat id 
        do {
            // membuat random id 
            $id_user = 'user_' . uniqid() . '_' . random_int(1000, 9999);
            
            // cek apa id sudah ada
            $user = $this->users->where('id_user', $id_user)->first();
        } while ($user); // Ulangi jika ID sudah ada

        $data = [
            'id_user' => $id_user,
            'nama_users' => $this->request->getPost('nama_users'),
            'email' => $email,
            'password' => $passwordHash,
            'profile' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'
        ];

        // Jalankan query insert dari model
        $simpan = $this->users->insert_user($data);

        if ($simpan) {
            // Jika insert berhasil, tampilkan pesan sukses dan arahkan ke halaman login
            session()->setFlashdata('success', 'Berhasil membuat akun');
            return redirect()->to('/login');
        } else {
            // Jika gagal insert, beri peringatan
            session()->setFlashdata('error1', ['Gagal membuat akun. Silakan coba lagi.']);
            return redirect()->to('/register');
        }
    }
// --=========================================|| LOGOUT ||================================================--
    // LOGOUT DISINI
    public function logout()
    {
        if (session()->get('access_token')) {
            $this->googleClient->revokeToken(session()->get('access_token'));
            session()->remove('access_token');
        }
        session()->setFlashdata('error', 'Anda Berhasil Logout..');
        session()->destroy();
        // dd(session());
        // die;
        return redirect()->to('/');
    }


// --=========================================|| PANEL ||================================================--
    public function dashboard(): string
    {
        return view('home');
    }
    
    public function services(): string
    {
        return view('services');
    }
}
