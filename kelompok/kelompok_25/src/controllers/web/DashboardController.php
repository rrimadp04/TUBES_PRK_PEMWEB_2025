<?php

/**
 * Dashboard Controller
 */

require_once ROOT_PATH . '/core/Controller.php';

class DashboardController extends Controller
{
    /**
     * Show dashboard
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'user' => current_user()
        ];

        $this->view('dashboard/index', $data);
    }
}
