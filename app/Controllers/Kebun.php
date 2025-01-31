<?php
namespace App\Controllers;

use App\Models\KebunModel;
use CodeIgniter\Controller;
use App\Models\TanamanKebunModel;

class Kebun extends BaseController
{
    protected $kebunModel;

    public function __construct()
    {
        $this->kebunModel = new KebunModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return view('buat_kebun'); 
    }

    public function buat()
    {
        // Validasi input form
        $validationRules = [
            'nama_kebun' => 'required',
            'poto_kebun' => 'uploaded[poto_kebun]|is_image[poto_kebun]|max_size[poto_kebun,2048]',
        ];
    
        if (!$this->validate($validationRules)) {
            // Simpan pesan error ke session
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('kelola_kebun')->withInput();
        }
    
        // Ambil data dari input
        $namaKebun = $this->request->getPost('nama_kebun');
        $file = $this->request->getFile('poto_kebun');
    
        // Ambil id_user dari session
        $idUser = session()->get('id_user'); // Pastikan session 'id_user' sudah ada
    
        if ($file->isValid() && !$file->hasMoved()) {
            // Simpan file ke folder public/uploads
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
    
            // Simpan data ke database dengan menambahkan id_user
            $this->kebunModel->save([
                'id_user' => $idUser, // Menyimpan id_user yang sedang login
                'nama_kebun' => $namaKebun,
                'poto_kebun' => $fileName,
            ]);
    
            // Set flashdata sukses
            session()->setFlashdata('success', 'Kebun berhasil dibuat!');
            return redirect()->to('kelola_kebun.php');
        }
    
        // Jika upload gagal
        session()->setFlashdata('error', 'Gagal mengunggah gambar');
        return redirect()->to('kelola_kebun')->withInput();
    }    

// --=========================================|| KELOLA KEBUN ||================================================--
    public function index_kelola()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $kebunModel = new KebunModel();
        $idUser = session()->get('id_user'); // Ambil id_user dari session yang sedang login
        $data['kebun'] = $kebunModel->where('id_user', $idUser)->findAll();
        return view('kelola_kebun.php', $data); // Panggil view dengan data
    }
    public function detail($id)
    {
        $kebunModel = new KebunModel();
        $tanamanKebunModel = new \App\Models\TanamanKebunModel(); // Model untuk tabel hubungan kebun dan tanaman
    
        // Cari data kebun berdasarkan ID
        $data['kebun'] = $kebunModel->find($id);
    
        // Jika data kebun tidak ditemukan
        if (!$data['kebun']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kebun dengan ID $id tidak ditemukan");
        }
    
        // Ambil daftar tanaman terkait dengan kebun ini
        $data['tanaman'] = $tanamanKebunModel
            ->select('tanaman_kebun.*, tanaman.common_name, tanaman.scientific_name') // Sesuaikan nama field
            ->join('tanaman', 'tanaman.id_tanaman = tanaman_kebun.id_tanaman') // Join dengan tabel tanaman
            ->where('tanaman_kebun.id_kebun', $id) // Filter berdasarkan id_kebun
            ->findAll();
    
        // Panggil view untuk menampilkan detail kebun
        return view('tanaman.php', $data);
    }

}
