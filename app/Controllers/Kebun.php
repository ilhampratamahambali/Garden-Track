<?php
namespace App\Controllers;

use App\Models\KebunModel;
use App\Models\TanamanKebunModel;

class Kebun extends BaseController
{
    protected $kebunModel;
    protected $tanamanKebunModel;


    public function __construct()
    {
        $this->tanamanKebunModel = new TanamanKebunModel();
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
            $file->move('uploads', $fileName);
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
    public function index_kelola()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $idUser = session()->get('id_user'); 
        $data['kebun'] = $this->kebunModel->where('id_user', $idUser)->findAll();
        return view('kelola_kebun', $data); 
    }
    public function detail($id)
    {
        // Cari data kebun berdasarkan ID
        $data['kebun'] = $this->kebunModel->find($id);
    
        // Jika data kebun tidak ditemukan
        if (!$data['kebun']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kebun dengan ID $id tidak ditemukan");
        }
    
        // Ambil daftar tanaman terkait dengan kebun ini
        $data['tanaman'] = $this->tanamanKebunModel
            ->select('tanaman_kebun.*, tanaman.common_name, tanaman.scientific_name') 
            ->join('tanaman', 'tanaman.id_tanaman = tanaman_kebun.id_tanaman') 
            ->where('tanaman_kebun.id_kebun', $id) 
            ->findAll();
    
        // Panggil view untuk menampilkan detail kebun
        return view('tanaman', $data);
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $data['kebun'] = $this->kebunModel->find($id);

        if (!$data['kebun']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kebun dengan ID $id tidak ditemukan");
        }

        return view('update_kebun', $data);
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

        // Ambil file dari request
        $file = $this->request->getFile('poto_kebun');

        // Pastikan file ada, valid, dan belum dipindahkan
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName(); 
            $file->move(ROOTPATH . 'public/uploads', $newName); 
            $data['poto_kebun'] = $newName; 

            // Debugging: Log nama file yang diunggah
            log_message('debug', 'File uploaded: ' . $newName);

            // Hapus file lama jika ada
            if ($kebun['poto_kebun'] && file_exists(ROOTPATH . 'public/uploads/' . $kebun['poto_kebun'])) {
                unlink(ROOTPATH . 'public/uploads/' . $kebun['poto_kebun']);
            }
        }

        $this->kebunModel->update($id, $data);

        return redirect()->to('kelola_kebun')->with('success', 'Kebun berhasil diperbarui.');
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

        return redirect()->to('kelola_kebun')->with('success', 'Kebun berhasil dihapus.');
    }
}

