<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan->groupBy('id');
    }

    public function collection()
    {
        return collect($this->laporan);
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Periksa',
            'Poli',
            'No Rekam Medik',
            'NIK',
            'Nama Pasien',
            'Umur',
            'Jenis Kelamin',
            'Jenis Bayar',
            'Diagnosa',
            'Daftar Obat'
        ];
    }

    public function map($items): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        $firstItem = $items->first();
        $obatList = $items->map(function ($item) {
            return $item->nama_obat ? $item->nama_obat . " (" . $item->jumlah_obat . ")" : '-';
        })->join(', ');

        return [
            $rowNumber,
            $firstItem->tanggal_periksa,
            $firstItem->poli,
            $firstItem->no_rekam_medik,
            $firstItem->nik,
            $firstItem->nama_pasien,
            $firstItem->umur,
            $firstItem->jenis_kelamin,
            $firstItem->jenis_bayar,
            $firstItem->diagnosa ?? '-',
            $obatList
        ];
    }
}
