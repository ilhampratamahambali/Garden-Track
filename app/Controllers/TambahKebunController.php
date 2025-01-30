<?php
namespace App\Controllers;

use App\Models\KebunModel;
use CodeIgniter\Controller;

class TambahKebunController extends BaseController
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
}
