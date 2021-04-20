<?php

namespace App\Controllers;

use TCPDF;
use MYPDF;


class Pdf extends BaseController
{
    protected $karyawan;
    public function __construct()
    {
        $this->karyawan = new \App\Models\karyawan_model();
        $this->item = new \App\Models\item_model();
        $this->stokout = new \App\Models\stok_out_model();
        $this->transaksi = new \App\Models\orders_model();
        $this->detail = new \App\Models\order_success_model();
        $this->bahan = new \App\Models\bahanitem_model();
        $this->bahan_detail = new \App\Models\bahan_model();
    }
    public function karyawan()
    {
        $getKaryawan = $this->karyawan->findAll();
        $data = [
            'karyawan' => $getKaryawan
        ];

        return view('pages/pdf/karyawan_pdf', $data);
        // $pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);
        // $pdf->SetCreator(PDF_CREATOR);
        // $pdf->SetAuthor('HallRoastery');
        // $pdf->SetTitle('Invoice');
        // $pdf->SetSubject('Invoice');
        // //
        // // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        // $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        // //
        // $pdf->setPrintHeader(true);
        // $pdf->setPrintFooter(true);

        // $pdf->addPage();
        // // output the HTML content
        // $pdf->writeHTML($html, true, false, true, false, '');
        // //line ini penting
        // $this->response->setContentType('application/pdf');
        // //Close and output PDF document
        // $pdf->Output('invoice.pdf', 'I');
    }
    public function transaksi()
    {
        $post = $this->request->getPost();

        if (empty($post['tgl_awal']) || empty($post['tgl_akhir'])) {
            $query = "SELECT * FROM orders ";
            $transaksi = $this->transaksi->query($query)->getResultArray();
            $label = "Semua Record";
        } else {
            $query = "SELECT * FROM orders WHERE create_at BETWEEN '$post[tgl_awal]'AND '$post[tgl_akhir]'";
            $transaksi = $this->transaksi->query($query)->getResultArray();
            $tgl_awal = date('Y-m-d', strtotime($post['tgl_awal']));
            $tgl_akhir = date('Y-m-d', strtotime($post['tgl_akhir']));
            $label = "Periode Tanggal :" . $post['tgl_awal'] . " - " . $post['tgl_akhir'];
            $sum = "SELECT SUM(total_transaksi ) as total FROM orders  WHERE create_at BETWEEN '$post[tgl_awal]'AND '$post[tgl_akhir]'";
            $getSum = $this->transaksi->query($sum)->getRow();
        }

        $data = [
            'transaksi' => $transaksi,
            'label' => $label,
            'total' => $getSum
        ];
        // PDF
        $html = view('pages/pdf/transaksi', $data);
        $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Hall Roastery');
        $pdf->SetTitle('Laporan Transaksi ' . $tgl_awal . " " . $tgl_akhir);
        $pdf->SetSubject('Laporan');

        //header

        $pdf->setPrintHeader(FALSE);
        $pdf->setPrintFooter(true);

        $pdf->addPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        //line ini penting
        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('laporan.pdf', 'I');
        // return view('pages/pdf/transaksi', $data);
    }
    public function stokout()
    {
        $post = $this->request->getPost();

        if (empty($post['tgl_awal']) || empty($post['tgl_akhir'])) {
            $stokout = $this->stokout->findAll();
            $label = "Semua Record";
        } else {
            $query = "SELECT * FROM stok_out WHERE create_at BETWEEN '$post[tgl_awal]' AND '$post[tgl_akhir]'";

            $tgl_awal = date('Y-m-d', strtotime($post['tgl_awal']));
            $tgl_akhir = date('Y-m-d', strtotime($post['tgl_akhir']));
            $label = "Periode Tanggal :" . $post['tgl_awal'] . " - " . $post['tgl_akhir'];
            // $sum = "SELECT SUM(total_transaksi ) as total FROM orders  WHERE create_at BETWEEN '$post[tgl_awal]'AND '$post[tgl_akhir]'";
            // $getSum = $this->transaksi->query($sum)->getRow();
            $query = "SELECT * FROM orders WHERE create_at BETWEEN '$post[tgl_awal]'AND '$post[tgl_akhir]'";
            $transaksi = $this->transaksi->query($query)->getFieldCount();
            // GET transaksi per Tanggal
            $fieldBahan = [
                'bahan.id as id',
                'bahan.name as name',
                'bahan.stok as stok',
                'bahan.perstok_satuan as perstok_satuan',
                'bahan.perstok_ukuran as perstok_ukuran',
                'bahan.perstok_name as perstok_name',
                'satuan.name as satuan',
                'satuan.id as satuan_id'
            ];
            $this->bahan_detail->select($fieldBahan);
            $this->bahan_detail->join('satuan', 'bahan.perstok_satuan=satuan.id');
            $allBahan =  $this->bahan_detail->get()->getResultArray();
            foreach ($allBahan as $bahan) {
                $bahan['bahan'] = $bahan;
                // dd($array_stokId);
                $this->stokout->where('create_at >=', $post['tgl_awal']);
                $this->stokout->where('create_at <=', $post['tgl_akhir']);
                // $this->stokout->where('bahan_id', $bahan['id']);


                $this->stokout->selectSum('stok_out', 'stok_out');
                $total_stok = $this->stokout->get()->getRowArray();
                $array_stok[] = $total_stok;


                $array_total[] = [

                    'name' => $bahan['name'],
                    'stok_awal' => $bahan['stok'],
                    'stok_keluar' => $total_stok['stok_out'],
                    'ukuran' => $bahan['perstok_ukuran'],
                    'satuan' => $bahan['satuan'],
                    'nama_satuan' => $bahan['perstok_name'],

                ];
            }


            dd($array_total);
            // dd($transaksi);
        }

        $data = [
            'label' => $label
        ];

        // // PDF
        // $html = view('pages/pdf/stokout', $data);
        // $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

        // $pdf->SetCreator(PDF_CREATOR);
        // $pdf->SetAuthor('Hall Roastery');
        // $pdf->SetTitle('Laporan Bahan Keluar ' . $tgl_awal . " " . $tgl_akhir);
        // $pdf->SetSubject('Laporan');

        // //header

        // $pdf->setPrintHeader(FALSE);
        // $pdf->setPrintFooter(true);

        // $pdf->addPage();

        // // output the HTML content
        // $pdf->writeHTML($html, true, false, true, false, '');
        // //line ini penting
        // $this->response->setContentType('application/pdf');
        // //Close and output PDF document
        // $pdf->Output('laporan.pdf', 'I');
        // // return view('pages/pdf/transaksi', $data);
    }

    //--------------------------------------------------------------------

}
