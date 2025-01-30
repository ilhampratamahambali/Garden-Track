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

    private function fetchPlantsData($filter = null, $currentPage = 1) {
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
        $data = $this->fetchPlantsData(null, $currentPage);
        return view('plants', $data);
    }

    public function vegetable(){
        $currentPage = (int) $this->request->getGet('page') ?? 1;
        $data = $this->fetchPlantsData(true, $currentPage);
        return view('plants', $data);
    }
}
