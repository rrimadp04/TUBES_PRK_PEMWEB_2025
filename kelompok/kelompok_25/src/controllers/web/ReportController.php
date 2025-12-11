<?php

require_once __DIR__ . '/../../models/Material.php';
require_once __DIR__ . '/../../helpers/ExcelExporter.php';

class ReportController extends Controller {
    
    public function stockReport() {
        $materialModel = new Material();
        
        $search = $_GET['search'] ?? '';
        $categoryFilter = $_GET['category'] ?? '';
        $statusFilter = $_GET['status'] ?? '';
        
        $materials = $materialModel->getStockReport($search, $categoryFilter, $statusFilter);
        $summary = $materialModel->getStockSummary();
        $categories = $materialModel->getCategories();
        
        $this->view('reports/stock', [
            'materials' => $materials,
            'summary' => $summary,
            'categories' => $categories,
            'filters' => [
                'search' => $search,
                'category' => $categoryFilter,
                'status' => $statusFilter
            ]
        ]);
    }

    public function exportExcel() {
        $materialModel = new Material();
        
        $search = $_GET['search'] ?? '';
        $categoryFilter = $_GET['category'] ?? '';
        $statusFilter = $_GET['status'] ?? '';
        
        $materials = $materialModel->getStockReport($search, $categoryFilter, $statusFilter);
        
        ExcelExporter::exportStockReport($materials);
    }

    public function transactionReport() {
        // Method untuk menampilkan laporan transaksi
        // Implementasi sesuai kebutuhan
    }

    public function exportTransactions() {
        require_once __DIR__ . '/../../models/Transaction.php';
        
        $transactionModel = new Transaction();
        
        $type = $_GET['type'] ?? 'all';
        $startDate = $_GET['start_date'] ?? '';
        $endDate = $_GET['end_date'] ?? '';
        
        $transactions = $transactionModel->getTransactionReport($type, $startDate, $endDate);
        
        ExcelExporter::exportTransactionReport($transactions);
    }
}
