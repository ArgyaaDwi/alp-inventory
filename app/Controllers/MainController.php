<?php

namespace App\Controllers;

use App\Models\KomikModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MainController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    protected $komikModel;
    protected $kategoriModel;
    protected $productModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
        $this->kategoriModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }
    public function tes()
    {
        $komik = $this->komikModel->getKomik();
        return view('pages/tes', [
            'komik' => $komik
        ]);
    }
    public function index()
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

        $data = [
            'currentDate' => $currentDate,
            'categoryCount' => $this->kategoriModel->countAllResults(),
            'productCount' => $this->productModel->countAllResults()
        ];

        return view('pages/dashboard', $data);
    }


    public function detailKomik($slug)
    {
        $komik = $this->komikModel->getKomik($slug);
        // dd($komik);
        return view('pages/detail_tes', [
            'komik' => $komik
        ]);
        // echo $slug;
    }
    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function tambahKomik()
    {
        return view('pages/tes_create');
    }
    public function save()
    {
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);
        return redirect()->to('/testingbro');
    }
    public function show($id = null)
    {
        //
    }

    /** 
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
