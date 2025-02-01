<?php
namespace App\Controllers;

use App\Models\PlantModel;
use App\Models\TanamanKebunModel;
use App\Models\KebunModel;

class Tanaman extends BaseController
{
    private $apiToken;
    private $baseUrl = 'https://trefle.io/api/v1';
    protected $logger;
    protected $PlantModel;
    protected $TanamanKebunModel;
    protected $kebunModel;

    public function __construct(){
        $this->PlantModel = new PlantModel();
        $this->TanamanKebunModel = new TanamanKebunModel();
        $this->kebunModel = new KebunModel();
        $this->apiToken = env('TOKEN');
        $this->logger = \Config\Services::logger(); 
    }

    private function Tanaman($filter = null, $currentPage = 1) {
        $client = \Config\Services::curlrequest();

        // Set maximum page limit
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        if ($currentPage > 21863) {
            $currentPage = 21863;
        }

        // Prepare query parameters
        $query = [
            'token' => $this->apiToken,
            'page' => $currentPage
        ];
        if ($filter) {
            $query['filter[vegetable]'] = 'true';
        }

        // API Endpoint for fetching plant data
        $response = $client->get("{$this->baseUrl}/plants", ['query' => $query]);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
            return [
                'plants' => $data['data'],
                'currentPage' => $currentPage,
                'totalPages' => $data['meta']['last_page'] ?? 1
            ];
        } else {
            $this->logger->error('Failed to retrieve data from Trefle API', ['response' => $response->getBody()]);
            log_message('error', 'Gagal mengambil data dari Trefle API: ' . $response->getBody());
            return [
                'plants' => [],
                'currentPage' => $currentPage,
                'totalPages' => 1,
                'error' => 'Gagal mengambil data dari Trefle API. Silakan coba lagi nanti.'
            ];
        }
    }

    public function index(){
        $currentPage = (int) $this->request->getGet('page') ?? 1;
        $data = $this->Tanaman(null, $currentPage);
        return view('plants', $data);
    }


// --=========================================|| VEGETABLE ||================================================--
    public function vegetable(){
        // $currentPage = (int) $this->request->getGet('page') ?? 1;
        // $data = $this->Tanaman(true, $currentPage);
        // return view('plants', $data);
        // Tentukan path file JSON
        $jsonPath = FCPATH . 'tanaman/json/sayuran.json'; 

        // Cek apakah file JSON ada
        if (!file_exists($jsonPath)) {
            throw new \RuntimeException("File JSON tidak ditemukan: $jsonPath");
        }

        // Baca file JSON
        $jsonData = file_get_contents($jsonPath);

        // Decode JSON ke array
        $plants = json_decode($jsonData, true);

        // Siapkan data untuk dikirim ke view
        $data = [
            'plants' => $plants
        ];

        // Load view dan kirim data
        return view('vegetable', $data);
    }
// ------------------------------------------------++BARENG++-----------------------------------------------
    // public function vegetable()
    // {
    //     // Load data pertama kali (30 data pertama)
    //     $data['plants'] = $this->getPlants(0, 30); // Ambil 30 data pertama
    //     return view('vegetable', $data);
    // }

    // public function loadMore($offset)
    // {
    //     // Ambil 30 data berikutnya berdasarkan offset
    //     $plants = $this->getPlants($offset, 30);

    //     // Jika tidak ada data lagi, kembalikan array kosong
    //     if (empty($plants)) {
    //         return $this->response->setJSON([]);
    //     }

    //     // Kirim data dalam format JSON
    //     return $this->response->setJSON($plants);
    // }

    // private function getPlants($offset, $limit)
    // {
    //     // Load file JSON
    //     $jsonPath = FCPATH . 'tanaman/json/sayuran.json';
    //     $jsonData = file_get_contents($jsonPath);
    //     $allPlants = json_decode($jsonData, true);

    //     // Ambil data sesuai offset dan limit
    //     return array_slice($allPlants, $offset, $limit);
    // }
// ------------------------------------------------++Bareng++---------------------------------------------------
    // public function index(){
    //     $client = \Config\Services::curlrequest();
    //     $plantModel = new PlantModel();

    //     // Ambil halaman saat ini dari parameter URL, default 1
    //     $currentPage = (int) $this->request->getGet('page') ?? 1;
    //     if ($currentPage < 1) {
    //         $currentPage = 1;
    //     }

    //     // API Endpoint untuk mengambil data tanaman sayuran
    //     $response = $client->get("{$this->baseUrl}/plants", [
    //         'query' => [
    //             'filter[vegetable]' => 'true',
    //             'token' => $this->apiToken,
    //             'page' => $currentPage
    //         ]
    //     ]);

    //     if ($response->getStatusCode() === 200) {
    //         $data = json_decode($response->getBody(), true);

    //         if (!empty($data['data'])) {
    //             foreach ($data['data'] as $plant) {
    //                 // Periksa apakah data sudah ada di database berdasarkan trefle_id
    //                 $existingPlant = $plantModel->where('trefle_id', $plant['id'])->first();

    //                 if (!$existingPlant) {
    //                     // Simpan data ke database, termasuk URL gambar
    //                     $plantModel->insert([
    //                         'trefle_id' => $plant['id'],
    //                         'common_name' => $plant['common_name'] ?? 'Unknown',
    //                         'scientific_name' => $plant['scientific_name'] ?? 'Unknown',
    //                         'family' => $plant['family'] ?? null,
    //                         'genus' => $plant['genus'] ?? null,
    //                         'image_url' => $plant['image_url'] ?? ($plant['images']['original']['url'] ?? null) // Pastikan path ini benar
    //                     ]);                        
    //                 }
    //             }
    //         }

    //         return view('plants', [
    //             'plants' => $data['data'],
    //             'currentPage' => $currentPage,
    //             'totalPages' => $data['meta']['total_pages'] ?? 1
    //         ]);
    //     } else {
    //         // Log error atau tampilkan pesan error
    //         log_message('error', 'Gagal mengambil data dari Trefle API: ' . $response->getBody());
    //         return view('plants', [
    //             'plants' => [],
    //             'currentPage' => $currentPage,
    //             'totalPages' => 1,
    //             'error' => 'Gagal mengambil data dari Trefle API. Silakan coba lagi nanti.'
    //         ]);
    //     }
    // }
// --=========================================|| TANAMAN-KEBUN ||================================================--

    public function formTambah($id_kebun)
    {
        // Ambil data tanaman dari tabel master tanaman
        $dataTanaman = $this->PlantModel->findAll();
        return view('TambahTanaman', [
            'id_kebun' => $id_kebun,
            'dataTanaman' => $dataTanaman,
        ]);
    }
    
    public function tambah($kebunId)
    {
        $dataTanaman = $this->PlantModel->findAll();
        $data = [
            'id_kebun' => $kebunId,
            'dataTanaman' => $dataTanaman,
        ];
        // dd($data); die;
        return view('TambahTanaman', $data);
    }

    public function simpanTanaman()
    {
        // Validasi input tanaman
        $rules = [
            'id_tanaman' => 'required',
            'id_kebun' => 'required',
            'benih' => 'required|numeric',
            'cara_menanam' => 'required',
            'kondisi_matahari' => 'required',
            'tanggal_mulai' => 'required|valid_date',
            'tanggal_selesai' => 'required|valid_date',
            'deskripsi' => 'required',
        ];
        
        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('error', 'Input tidak valid')->with('validation_errors', $validation->getErrors());
        }

        // Ambil data tanaman
        $dataTanaman = [
            'id_tanaman' => $this->request->getPost('id_tanaman'),
            'id_kebun' => $this->request->getPost('id_kebun'),
            'id_user' => session()->get('id_user'),
            'benih' => $this->request->getPost('benih'),
            'cara_menanam' => $this->request->getPost('cara_menanam'),
            'kondisi_matahari' => $this->request->getPost('kondisi_matahari'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];
        // Simpan tanaman ke kebun
        $this->TanamanKebunModel->insert($dataTanaman);

        // Update status kebun menjadi "selesai"
        $this->kebunModel->update($dataTanaman['id_kebun'], ['status' => 'selesai']);

        return redirect()->to('/kelola_kebun')->with('success', 'Tanaman berhasil ditambahkan.');
    }
    
    // Method untuk menampilkan detail tanaman
    public function detail($id)
    {
        // Cari data tanaman kebun berdasarkan id
        $data['tanaman'] = $this->TanamanKebunModel
                ->select('tanaman_kebun.id, tanaman.common_name, tanaman.scientific_name')
                ->join('gardentrack.tanaman', 'tanaman.id_tanaman = tanaman_kebun.id_tanaman')
                ->where('tanaman_kebun.id_kebun', $id)
                ->findAll();
        // Jika tanaman tidak ditemukan
        if (!$data['tanaman']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Tanaman tidak ditemukan");
        }

        // Tampilkan halaman detail tanaman
        return view('detail_tanaman', $data);
    }

    // Method untuk menghapus tanaman dari kebun
    public function delete($id)
    {
        // Cek apakah tanaman dalam kebun ada berdasarkan ID
        $tanamanKebun = $this->TanamanKebunModel->find($id);

        if (!$tanamanKebun) {
            // Jika data tanaman tidak ditemukan, redirect dengan pesan error
            return redirect()->back()->with('error', 'Data tanaman tidak ditemukan.');
        }

        // Simpan ID kebun untuk redirect setelah hapus
        $id_kebun = $tanamanKebun['id_kebun'];

        // Hapus tanaman dari tabel tanaman_kebun berdasarkan ID
        if ($this->TanamanKebunModel->delete($id)) {
            // Redirect ke halaman kebun setelah tanaman berhasil dihapus
            return redirect()->to('/kebun/detail/' . $id_kebun)->with('success', 'Tanaman berhasil dihapus.');
        }

        // Jika gagal menghapus tanaman, redirect kembali dengan pesan error
        return redirect()->back()->with('error', 'Gagal menghapus tanaman.');
    }
}