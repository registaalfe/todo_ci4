<?php

namespace App\Controllers;

use App\Models\FilmModel;

class Film extends BaseController
{
    protected $filmModel;

    public function __construct()
    {
        $this->filmModel = new FilmModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Home | Film',
            'film' => $this->filmModel->getFilm()
        ];



        return view('film/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Film',
            'film' => $this->filmModel->getFilm($slug)
        ];

        // jika film tidak ada di tabel
        if (empty($data['film'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul film ' . $slug . ' tidak ditemukan.');
        }

        return view('film/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Film',
            'validation' => \Config\Services::validation()
        ];

        return view('film/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[film.judul]',
                'errors' => [
                    'required' => '{field} film harus diisi.',
                    'is_unique' => '{field} film sudah terdaftar.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/film/create')->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->filmModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'genre' => $this->request->getVar('genre'),
            'deskripsi' => $this->request->getVar('genre'),
            'gambar' => $this->request->getVar('gambar')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/film');
    }

    public function delete($id)
    {
        $this->filmModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/film');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Film',
            'validation' => \Config\Services::validation(),
            'film' => $this->filmModel->getFilm($slug)
        ];

        return view('film/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $filmLama = $this->filmModel->getFilm($this->request->getVar('slug'));
        if ($filmLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[film.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} film harus diisi.',
                    'is_unique' => '{field} film sudah terdaftar.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/film/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->filmModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'genre' => $this->request->getVar('genre'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar' => $this->request->getVar('gambar')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/film');
    }
}
