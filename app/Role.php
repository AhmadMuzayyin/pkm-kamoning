<?php

namespace App;

enum Role: string
{
    case KepalaRekamMedik = 'Kepala Rekam Medik';
    case Farmasi = 'Farmasi';
    case Kasir = 'Kasir';
    case Dokter = 'Dokter';
    case PetugasLoket = 'Petugas Loket';
}
