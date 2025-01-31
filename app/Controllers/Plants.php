<?php
namespace App\Controllers;

use App\Models\PlantModel;
use App\Models\TanamanKebunModel;

class Plants extends BaseController
{
    private $apiToken;
    private $baseUrl = 'https://trefle.io/api/v1';
    protected $logger;

    public function __construct(){
        $this->apiToken = env('TOKEN');
        $this->logger = \Config\Services::logger(); // Initialize logger
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

    public function vegetable(){
        $currentPage = (int) $this->request->getGet('page') ?? 1;
        $data = $this->Tanaman(true, $currentPage);
        return view('plants', $data);
    }

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
