<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KepalaController extends Controller
{
    public function index()
    {
        return view('pages.kepala.index');
    }
    public function laporan(Request $request)
    {
        $term = $request->get('term');
        $laporan = [];

        if ($term) {
            // Menentukan query berdasarkan term dan parameter lainnya
            switch ($term) {
                case 'harian':
                    $tanggal = $request->get('tanggal');
                    if ($tanggal) {
                        $laporan = $this->getLaporanHarian($tanggal);
                    }
                    break;

                case 'bulanan':
                    $bulan = $request->get('bulan');
                    if ($bulan) {
                        // Format bulan dari input type date (YYYY-MM-DD)
                        $month = substr($bulan, 5, 2);
                        $year = substr($bulan, 0, 4);
                        $laporan = $this->getLaporanBulanan($month, $year);
                    }
                    break;

                case 'tahunan':
                    $tahun = $request->get('tahun');
                    if ($tahun) {
                        $laporan = $this->getLaporanTahunan($tahun);
                    }
                    break;

                default:
                    $tanggalMulai = $request->get('tanggal_mulai');
                    $tanggalSelesai = $request->get('tanggal_selesai');
                    if ($tanggalMulai && $tanggalSelesai) {
                        $laporan = $this->getLaporanPeriode($tanggalMulai, $tanggalSelesai);
                    }
                    break;
            }
        }

        return view('pages.kepala.laporan', compact('laporan', 'term'));
    }

    // Method helper untuk query data
    private function getLaporanHarian($tanggal)
    {
        return DB::table('pendaftarans')
            ->join('kunjungans', 'pendaftarans.kunjungan_id', '=', 'kunjungans.id')
            ->leftJoin('pemeriksaans', 'pendaftarans.id', '=', 'pemeriksaans.pendaftaran_id')
            ->leftJoin('reseps', 'pendaftarans.id', '=', 'reseps.pendaftaran_id')
            ->leftJoin('obats', 'reseps.obat_id', '=', 'obats.id')
            ->select(
                'pendaftarans.id',
                'pendaftarans.tanggal_periksa',
                'pendaftarans.poli',
                'kunjungans.no_rekam_medik',
                'kunjungans.nik',
                'kunjungans.nama_pasien',
                'kunjungans.umur',
                'kunjungans.jenis_kelamin',
                'pendaftarans.jenis_bayar',
                'pemeriksaans.diagnosa',
                'obats.nama as nama_obat',
                'reseps.jumlah as jumlah_obat'
            )
            ->where('pendaftarans.tanggal_periksa', $tanggal)
            ->where('pendaftarans.status', 'Selesai')
            ->orderBy('pendaftarans.id')
            ->get();
    }

    private function getLaporanBulanan($month, $year)
    {
        return DB::table('pendaftarans')
            ->join('kunjungans', 'pendaftarans.kunjungan_id', '=', 'kunjungans.id')
            ->leftJoin('pemeriksaans', 'pendaftarans.id', '=', 'pemeriksaans.pendaftaran_id')
            ->leftJoin('reseps', 'pendaftarans.id', '=', 'reseps.pendaftaran_id')
            ->leftJoin('obats', 'reseps.obat_id', '=', 'obats.id')
            ->select(
                'pendaftarans.id',
                'pendaftarans.tanggal_periksa',
                'pendaftarans.poli',
                'kunjungans.no_rekam_medik',
                'kunjungans.nik',
                'kunjungans.nama_pasien',
                'kunjungans.umur',
                'kunjungans.jenis_kelamin',
                'pendaftarans.jenis_bayar',
                'pemeriksaans.diagnosa',
                'obats.nama as nama_obat',
                'reseps.jumlah as jumlah_obat'
            )
            ->whereMonth('pendaftarans.tanggal_periksa', $month)
            ->whereYear('pendaftarans.tanggal_periksa', $year)
            ->where('pendaftarans.status', 'Selesai')
            ->orderBy('pendaftarans.id')
            ->get();
    }

    private function getLaporanTahunan($year)
    {
        return DB::table('pendaftarans')
            ->join('kunjungans', 'pendaftarans.kunjungan_id', '=', 'kunjungans.id')
            ->leftJoin('pemeriksaans', 'pendaftarans.id', '=', 'pemeriksaans.pendaftaran_id')
            ->leftJoin('reseps', 'pendaftarans.id', '=', 'reseps.pendaftaran_id')
            ->leftJoin('obats', 'reseps.obat_id', '=', 'obats.id')
            ->select(
                'pendaftarans.id',
                'pendaftarans.tanggal_periksa',
                'pendaftarans.poli',
                'kunjungans.no_rekam_medik',
                'kunjungans.nik',
                'kunjungans.nama_pasien',
                'kunjungans.umur',
                'kunjungans.jenis_kelamin',
                'pendaftarans.jenis_bayar',
                'pemeriksaans.diagnosa',
                'obats.nama as nama_obat',
                'reseps.jumlah as jumlah_obat'
            )
            ->whereYear('pendaftarans.tanggal_periksa', $year)
            ->where('pendaftarans.status', 'Selesai')
            ->orderBy('pendaftarans.id')
            ->get();
    }

    private function getLaporanPeriode($tanggalMulai, $tanggalSelesai)
    {
        return DB::table('pendaftarans')
            ->join('kunjungans', 'pendaftarans.kunjungan_id', '=', 'kunjungans.id')
            ->leftJoin('pemeriksaans', 'pendaftarans.id', '=', 'pemeriksaans.pendaftaran_id')
            ->leftJoin('reseps', 'pendaftarans.id', '=', 'reseps.pendaftaran_id')
            ->leftJoin('obats', 'reseps.obat_id', '=', 'obats.id')
            ->select(
                'pendaftarans.id',
                'pendaftarans.tanggal_periksa',
                'pendaftarans.poli',
                'kunjungans.no_rekam_medik',
                'kunjungans.nik',
                'kunjungans.nama_pasien',
                'kunjungans.umur',
                'kunjungans.jenis_kelamin',
                'pendaftarans.jenis_bayar',
                'pemeriksaans.diagnosa',
                'obats.nama as nama_obat',
                'reseps.jumlah as jumlah_obat'
            )
            ->whereBetween('pendaftarans.tanggal_periksa', [$tanggalMulai, $tanggalSelesai])
            ->where('pendaftarans.status', 'Selesai')
            ->orderBy('pendaftarans.id')
            ->get();
    }
    public function export(Request $request)
    {
        $term = $request->get('term');
        $laporan = [];

        // Gunakan fungsi yang sama seperti method laporan untuk mendapatkan data
        switch ($term) {
            case 'harian':
                $tanggal = $request->get('tanggal');
                if ($tanggal) {
                    $laporan = $this->getLaporanHarian($tanggal);
                }
                break;

            case 'bulanan':
                $bulan = $request->get('bulan');
                if ($bulan) {
                    $month = substr($bulan, 5, 2);
                    $year = substr($bulan, 0, 4);
                    $laporan = $this->getLaporanBulanan($month, $year);
                }
                break;

            case 'tahunan':
                $tahun = $request->get('tahun');
                if ($tahun) {
                    $laporan = $this->getLaporanTahunan($tahun);
                }
                break;

            default:
                $tanggalMulai = $request->get('tanggal_mulai');
                $tanggalSelesai = $request->get('tanggal_selesai');
                if ($tanggalMulai && $tanggalSelesai) {
                    $laporan = $this->getLaporanPeriode($tanggalMulai, $tanggalSelesai);
                }
                break;
        }

        // Implementasi export ke Excel
        // Jika menggunakan package Laravel Excel
        return Excel::download(new LaporanExport($laporan), 'laporan_' . $term . '_' . date('Y-m-d') . '.xlsx');
    }
}
