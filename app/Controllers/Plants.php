<?php
namespace App\Controllers;

class Plants extends BaseController
{
    private $apiToken;
    private $baseUrl = 'https://trefle.io/api/v1';
    protected $logger;

    public function __construct(){
        $this->apiToken = env('TOKEN');
        $this->logger = \Config\Services::logger(); // Initialize logger
    }

    public function index(){
        $client = \Config\Services::curlrequest();

        // Ambil halaman saat ini dari parameter URL, default 1
        $currentPage = (int) $this->request->getGet('page') ?? 1;
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        // Set maximum page limit
        if ($currentPage > 21863) {
            $currentPage = 21863;
        }

        // API Endpoint untuk mengambil data tanaman sayuran
        $response = $client->get("{$this->baseUrl}/plants", [
            'query' => [
                'filter[vegetable]' => 'true',
                'token' => $this->apiToken,
                'page' => $currentPage
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $this->logger->info('Data retrieved successfully', ['currentPage' => $currentPage, 'totalPages' => $data['meta']['last_page'] ?? 1]); // Log successful retrieval

            $data = json_decode($response->getBody(), true);
            return view('plants', [
                'plants' => $data['data'],
                'currentPage' => $currentPage,
                'totalPages' => $data['meta']['last_page'] ?? 1 // Pastikan ini sesuai dengan respons API
            ]);
        } else {
            $this->logger->error('Failed to retrieve data from Trefle API', ['response' => $response->getBody()]); // Log error

            log_message('error', 'Gagal mengambil data dari Trefle API: ' . $response->getBody());
            return view('plants', [
                'plants' => [],
                'currentPage' => $currentPage,
                'totalPages' => 1,
                'error' => 'Gagal mengambil data dari Trefle API. Silakan coba lagi nanti.'
            ]);
        }
    }
}
