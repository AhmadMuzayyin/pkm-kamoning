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
        $this->laporan = $laporan;
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
            'No Rekam Medik',
            'NIK',
            'Nama Pasien',
            'Umur',
            'Jenis Kelamin',
            'Jenis Bayar',
            'Diagnosa',
            'Nama Obat'
        ];
    }

    public function map($item): array
    {
        static $row = 0;
        $row++;

        return [
            $row,
            $item->tanggal_periksa,
            $item->no_rekam_medik,
            $item->nik,
            $item->nama_pasien,
            $item->umur,
            $item->jenis_kelamin,
            $item->jenis_bayar,
            $item->diagnosa ?? '-',
            $item->nama_obat ?? '-'
        ];
    }
}
