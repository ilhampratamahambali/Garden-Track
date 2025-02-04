<?php

namespace App\Controllers;

use App\Models\komentarModel;

class komentarController extends BaseController{
  
    public function addComment()
    {
        $validationRules = [
            'komentar' => 'required|string',
            'id_kebun' => 'required|integer',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $komentar = $this->request->getPost('komentar');
        $id_user = session()->get('id_user');
        $id_kebun = $this->request->getPost('id_kebun');
        $induk_komentar_id = $this->request->getPost('induk_komentar_id') ?: null;
    
        $komentarModel = new komentarModel();
        $komentarModel->insert([
            'komentar' => $komentar,
            'id_user' => $id_user,
            'id_kebun' => $id_kebun,
            'induk_komentar_id' => $induk_komentar_id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
    

}