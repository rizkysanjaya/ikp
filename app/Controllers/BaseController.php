<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }
    /**
     * Helper to calculate IKM Statistics based on a list of Respondent IDs
     * Shared between Home (Landing Page) and Admin Dashboard
     */
    protected function calculateIKM($db, $respondentIds, $listUnsur)
    {
        $totalUnsur = count($listUnsur);
        $weight = $totalUnsur > 0 ? 1 / $totalUnsur : 0;
        $totalResponders = count($respondentIds);

        $ikpKonversi = 0;
        $nrrPerUnsur = [];
        // Init defaults
        foreach($listUnsur as $u) {
            $nrrPerUnsur[$u->id] = 0;
        }

        if ($totalResponders > 0) {
            // Get Answers
            $answers = $db->table('trans_detail_jawaban')
                ->select('trans_detail_jawaban.nilai_skor, ref_soal.unsur_id')
                ->join('ref_soal', 'ref_soal.id = trans_detail_jawaban.soal_id')
                ->whereIn('trans_detail_jawaban.responden_id', $respondentIds)
                ->get()->getResultArray();

            // Sum Score per Unsur
            $scorePerUnsur = [];
            foreach ($answers as $ans) {
                $uId = $ans['unsur_id'];
                if (!isset($scorePerUnsur[$uId])) $scorePerUnsur[$uId] = 0;
                $scorePerUnsur[$uId] += $ans['nilai_skor'];
            }

            // Calculate NRR & IKP
            $sumWeightedNRR = 0;
            foreach ($listUnsur as $u) {
                $totalScore = $scorePerUnsur[$u->id] ?? 0;
                $nrr = $totalScore / $totalResponders;
                $nrrPerUnsur[$u->id] = number_format($nrr, 2); 
                
                $weightedNRR = $nrr * $weight;
                $sumWeightedNRR += $weightedNRR;
            }
            $ikpKonversi = $sumWeightedNRR * 25;
        }

        // Determine Mutu
        $mutu = '-'; $ket = 'Belum Ada Data'; $classColor = 'gray';
        if ($totalResponders > 0) {
            if ($ikpKonversi >= 88.31) {
                $mutu = 'A'; $ket = 'Sangat Baik'; $classColor = 'emerald';
            } elseif ($ikpKonversi >= 76.61) {
                $mutu = 'B'; $ket = 'Baik'; $classColor = 'blue';
            } elseif ($ikpKonversi >= 65.00) {
                $mutu = 'C'; $ket = 'Kurang Baik'; $classColor = 'yellow';
            } else {
                $mutu = 'D'; $ket = 'Tidak Baik'; $classColor = 'red';
            }
        }

        return [
            'ikm_konversi' => $ikpKonversi,
            'ikm_formatted' => number_format($ikpKonversi, 2),
            'mutu' => $mutu,
            'ket' => $ket,
            'class_color' => $classColor,
            'nrr_per_unsur' => $nrrPerUnsur,
            'total_responden' => $totalResponders
        ];
    }
}
