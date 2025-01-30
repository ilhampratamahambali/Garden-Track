<?php

namespace App\Controllers;

use App\Models\KebunModel;
use App\Models\TanamanKebunModel;

class KelolaKebunController extends BaseController
{
    public function index()
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
