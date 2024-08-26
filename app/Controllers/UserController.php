<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        
    }
    public function viewProfile()
    {
        $locale = 'id_ID'; // Locale Bahasa Indonesia
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Jakarta'
        );
        $tanggal = new \DateTime();
        $currentDate = $formatter->format($tanggal); // Format tanggal
        return view('pages/user/profile', ['currentDate' => $currentDate]);
    }
}
