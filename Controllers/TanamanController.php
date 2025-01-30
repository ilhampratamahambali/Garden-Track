<?php
namespace App\Controllers;

use App\Models\PlantModel;
use App\Models\TanamanKebunModel;

class TanamanController extends BaseController
{
    public function formTambah($id_kebun)
    {
        $PlantModel = new PlantModel();

        // Ambil data tanaman dari tabel master tanaman
        $dataTanaman = $PlantModel->findAll();

        return view('TambahTanaman.php', [
            'id_kebun' => $id_kebun,
            'dataTanaman' => $dataTanaman,
        ]);
    }

    public function tambah()
{
    $TanamanKebunModel = new TanamanKebunModel(); // Model untuk menghubungkan tanaman dan kebun
    
    $data = [
        'id_kebun' => $this->request->getPost('id_kebun'), // ID Kebun yang sudah ada
        'id_tanaman' => $this->request->getPost('id_tanaman'), // ID Tanaman yang dipilih
        'id_user' => session()->get('id_user'), // Ambil ID User dari session
    ];

    if ($TanamanKebunModel->insert($data)) {
        return redirect()->to('/kebun/detail/' . $data['id_kebun'])->with('success', 'Tanaman berhasil ditambahkan.');
    }

    return redirect()->back()->with('error', 'Gagal menambahkan tanaman.');
}

}
