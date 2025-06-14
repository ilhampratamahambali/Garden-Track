<?php
namespace App\Controllers;

use App\Models\KebunModel;
use App\Models\TanamanKebunModel;
use App\Models\komentarModel;
use App\Models\UsersModel;

class Kebun extends BaseController
{
    protected $kebunModel;
    protected $tanamanKebunModel;
    protected $komentarModel;
    protected $usermodel;

    public function __construct()
    {
        $this->tanamanKebunModel = new TanamanKebunModel();
        $this->kebunModel = new KebunModel();
        $this->komentarModel = new komentarModel();
        $this->usermodel = new UsersModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $data = [
            'noFooter' => true,
            'title' => 'Buat Kebun'
        ];
        return view('kebun/buat_kebun', $data); 
    }

    public function buat()
    {
        // Validasi input form
        $rules = [
            'nama_kebun' => 'required|max_length[255]',
            'poto_kebun' => 'uploaded[poto_kebun]|is_image[poto_kebun]|max_size[poto_kebun,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Input tidak valid');
        }

        // Ambil data dari request
        $namaKebun = $this->request->getPost('nama_kebun');
        $file = $this->request->getFile('poto_kebun');
        $idUser = session()->get('id_user');

        if (!$idUser) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/kebun/', $fileName);
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
        }

        // Simpan ke database
        $dataKebun = [
            'id_user' => $idUser,
            'nama_kebun' => $namaKebun,
            'poto_kebun' => $fileName,
            'status' => 'belum', // Default status
        ];

        $this->kebunModel->insert($dataKebun);
        $kebunId = $this->kebunModel->insertID(); // Ambil ID kebun yang baru dibuat

        // Redirect ke halaman tambah tanaman dengan membawa ID kebun
        return redirect()->to('/tanaman/tambah/' . $kebunId);
    }
// --=========================================|| KELOLA KEBUN ||================================================--
    public function kebun()
    {
        // Pastikan pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $idUser = session()->get('id_user'); 
        $kebun = $this->kebunModel->getKebunByUser($idUser);
        $user = $this->usermodel->get_user_id($idUser);

        $data = [
            'title' => 'Kebun Saya',
            'kebun' => $kebun,
            'user' => $user,
        ] ;
        return view('kebun/kebun', $data); 
    }

    public function kebunOrang($id_user)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $kebun = $this->kebunModel->getKebunByUser($id_user);

        if (empty($kebun)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Tidak ada kebun ditemukan untuk pengguna ini.");
        }

        $data = [
            'title' => 'Kebun',
            'kebun' => $kebun,
        ];
        return view('kebun/kebun', $data);
    }

    public function detail($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $kebun = $this->kebunModel->find($id);
        // Jika data kebun tidak ditemukan
        if (!$kebun) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kebun dengan tidak ditemukan");
        }
        // Ambil daftar tanaman terkait dengan kebun ini
        $tanaman = $this->tanamanKebunModel->getTanamanByKebun($id);
        $komentar = $this->komentarModel->getKomentarByKebun($id);
        $data = [
            'title' => 'Detail Kebun',
            'noFooter' => true,
            'kebun' => $kebun,
            'tanaman' => $tanaman,
            'komentar' => $komentar,
            'idUserLogin' => session()->get('id_user')
        ];
        
        return view('kebun/tanaman', $data);
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $kebun = $this->kebunModel->find($id);

        if (!$kebun) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kebun dengan ID $id tidak ditemukan");
        }

        $data = [
            'kebun' => $kebun,
            'noFooter' => true,
            'title' => 'Edit Kebun'
        ];
        return view('kebun/update_kebun', $data);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $kebun = $this->kebunModel->find($id);

        if (!$kebun) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kebun dengan ID $id tidak ditemukan");
        }

        $rules = [
            'nama_kebun' => 'required|min_length[3]|max_length[255]',
            'poto_kebun' => 'if_exist|max_size[poto_kebun,2048]|is_image[poto_kebun]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_kebun' => $this->request->getPost('nama_kebun'),
        ];
        $file = $this->request->getFile('poto_kebun');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName(); 
            $file->move(ROOTPATH . 'public/uploads/kebun/', $newName); 
            $data['poto_kebun'] = $newName; 

            log_message('debug', 'File uploaded: ' . $newName);

            // Hapus file lama jika ada dan bukan default.png
            if ($kebun['poto_kebun'] && $kebun['poto_kebun'] !== 'default.png' && file_exists(ROOTPATH . 'public/uploads/kebun/' . $kebun['poto_kebun'])) {
                unlink(ROOTPATH . 'public/uploads/kebun/' . $kebun['poto_kebun']);
            }
        }

        $this->kebunModel->update($id, $data);

        return redirect()->to('kebun')->with('success', 'Kebun berhasil diperbarui.');
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $kebun = $this->kebunModel->find($id);

        if (!$kebun) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kebun dengan ID $id tidak ditemukan");
        }

        // Hapus file gambar jika ada
        if ($kebun['poto_kebun'] && file_exists(WRITEPATH . 'uploads/' . $kebun['poto_kebun'])) {
            unlink(WRITEPATH . 'uploads/' . $kebun['poto_kebun']);
        }

        $this->kebunModel->delete($id);

        return redirect()->to('kebun')->with('success', 'Kebun berhasil dihapus.');
    }
// --=========================================|| SEMUA KEBUN ||================================================--
    public function allkebun(){
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $kebunData = $this->kebunModel->getKebunData();

        // **Mengelompokkan data berdasarkan id_kebun**
        $kebunList = [];

        foreach ($kebunData as $item) {
            $id_kebun = $item['id_kebun'];
            if (!isset($kebunList[$id_kebun])) {
                // Jika kebun belum ada di array, buat data baru
                $kebunList[$id_kebun] = [
                    'id_kebun' => $id_kebun,
                    'nama_kebun' => $item['nama_kebun'],
                    'poto_kebun' => $item['poto_kebun'],
                    'id_user'=> $item['id_user'],
                    'nama_users' => $item['nama_users'],
                    'email' => $item['email'],
                    'profile' => $item['profile'],
                    'tanaman' => [],
                    'progress' => 0,
                    'total_progress' => 0,
                    'jumlah_tanaman' => 0,
                ];
            }

            // **Perhitungan progress untuk setiap tanaman**
            if (!empty($item['tanggal_mulai']) && !empty($item['tanggal_selesai'])) {
                // Konversi tanggal ke timestamp
                $tanggalMulai = strtotime(date('Y-m-d', strtotime($item['tanggal_mulai'])));
                $tanggalSekarang = strtotime(date('Y-m-d')); 
                $tanggalSelesai = strtotime(date('Y-m-d', strtotime($item['tanggal_selesai'])));

                // Menghitung jumlah total hari
                $jumlahHari = ($tanggalSelesai - $tanggalMulai) / (60 * 60 * 24);

                // Menghitung hari yang telah berlalu (termasuk hari ini)
                $hariYangBerjalan = ($tanggalSekarang - $tanggalMulai) / (60 * 60 * 24);

                // Menghitung progress hari
                if ($tanggalSekarang < $tanggalMulai) {
                    $progressHari = 0;
                    $progresBar = 0;
                } elseif ($tanggalSekarang >= $tanggalSelesai) {
                    $progressHari = $jumlahHari;
                    $progresBar = 100;
                } else {
                    $progressHari = $hariYangBerjalan;
                    $progresBar = ($progressHari / $jumlahHari) * 100;
                }

                // Tambahkan tanaman ke array tanaman dalam kebun ini
                $kebunList[$id_kebun]['tanaman'][] = [
                    'nama' => $item['common_name'],
                    'tanggal_selesai' => date('Y-m-d', $tanggalSelesai), 
                    'progress' => round($progresBar),  
                ];

                // Update total progress kebun
                $kebunList[$id_kebun]['total_progress'] += $progresBar;
                $kebunList[$id_kebun]['jumlah_tanaman']++;
            }
        }

        // **Hitung rata-rata progress untuk setiap kebun**
        foreach ($kebunList as &$kebun) {
            if ($kebun['jumlah_tanaman'] > 0) {
                $kebun['progress'] = round($kebun['total_progress'] / $kebun['jumlah_tanaman']);
            }
        }

        // Data untuk ditampilkan di view
        $data = [
            'title' => 'Kebun Saya',
            'kebun' => $kebunList
        ];

        return view('kebun/allkebun', $data); 
    }

    public function Komentar()
    {
        $validationRules = [
            'komentar' => 'required|string',
            'id_kebun' => 'required|integer',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $komentar = $this->request->getPost('komentar');
        $id_user = session()->get('id_user');
        $id_kebun = $this->request->getPost('id_kebun');
        $induk_komentar_id = $this->request->getPost('induk_komentar_id') ?: null;
        // dd($komentar, $id_user, $id_kebun, $induk_komentar_id);
        // die;
        $this->komentarModel->insert([
            'komentar' => $komentar,
            'id_user' => $id_user,
            'id_kebun' => $id_kebun,
            'induk_komentar_id' => $induk_komentar_id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}