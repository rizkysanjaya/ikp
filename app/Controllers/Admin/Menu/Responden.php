<?php

namespace App\Controllers\Admin\Menu;

use App\Controllers\BaseController;
use App\Models\SurveyRespondenModel;
use App\Models\SurveyJawabanModel;

class Responden extends BaseController
{
    public function index()
    {
        $respondenModel = new SurveyRespondenModel();
        $jawabanModel = new SurveyJawabanModel();

        // 1. Fetch Respondents with related Master Data
        $respondents = $respondenModel->select('trans_responden.*, ref_jenis_layanan.nama_layanan, ref_pendidikan.nama_pendidikan, ref_pekerjaan.nama_pekerjaan')
            ->join('ref_jenis_layanan', 'ref_jenis_layanan.id = trans_responden.jenis_layanan_id')
            ->join('ref_pendidikan', 'ref_pendidikan.id = trans_responden.pendidikan_id')
            ->join('ref_pekerjaan', 'ref_pekerjaan.id = trans_responden.pekerjaan_id')
            ->orderBy('trans_responden.id', 'DESC')
            ->findAll();

        // 2. Fetch Answers with Unsur Data
        // We fetch all answers to avoid N+1 queries, then group them by respondent in PHP
        $answers = $jawabanModel->select('trans_detail_jawaban.responden_id, trans_detail_jawaban.nilai_skor, ref_unsur_pelayanan.kode_unsur, ref_unsur_pelayanan.nama_unsur, ref_soal.pertanyaan')
            ->join('ref_soal', 'ref_soal.id = trans_detail_jawaban.soal_id')
            ->join('ref_unsur_pelayanan', 'ref_unsur_pelayanan.id = ref_soal.unsur_id')
            ->orderBy('ref_unsur_pelayanan.id', 'ASC')
            ->findAll();

        // Group answers by respondent_id
        $answersByRespondent = [];
        foreach ($answers as $ans) {
            $answersByRespondent[$ans->responden_id][] = $ans;
        }

        // Attach answers to respondent objects
        foreach ($respondents as $r) {
            $r->answers = $answersByRespondent[$r->id] ?? [];
        }

        $data = [
            'title' => 'Data Responden',
            'respondents' => $respondents
        ];

        return view('admin/menu/responden', $data);
    }

    public function delete($id)
    {
        $model = new SurveyRespondenModel();
        $model->delete($id);
        return redirect()->to('admin/responden')->with('success', 'Data responden berhasil dihapus.');
    }
}
