<?php

namespace Database\Seeders;

use App\Models\KetuaRt;
use Illuminate\Database\Seeder;

class KetuaRtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ketuaRtList = [
            // ['rt' => '001', 'rw' => '001', 'nama' => 'KASIRIN', 'nik' => '3522150609760006', 'no_whatsapp' => '6281230854656'],
            // ['rt' => '002', 'rw' => '001', 'nama' => 'SUPITONO WITO WASESO', 'nik' => '3522151102680004', 'no_whatsapp' => '6281232065705'],
            // ['rt' => '003', 'rw' => '001', 'nama' => 'INDAH SYAHFRIYANTI', 'nik' => '3522156608760007', 'no_whatsapp' => '6281359465946'],
            // ['rt' => '004', 'rw' => '001', 'nama' => 'ARIF ZAINUDDIN', 'nik' => '3522152901770003', 'no_whatsapp' => '6285230878527'],
            // ['rt' => '005', 'rw' => '001', 'nama' => 'DONI AGUS SETYAWAN', 'nik' => '3522150508690005', 'no_whatsapp' => '6285233665259'],
            // ['rt' => '006', 'rw' => '001', 'nama' => 'HARDY DJANOERI (HERU)', 'nik' => '3522152201700005', 'no_whatsapp' => '6282330581043'],
            // ['rt' => '007', 'rw' => '001', 'nama' => 'BUDI UTOMO, S.HUT', 'nik' => '3522151706720004', 'no_whatsapp' => '62895395389863'],
            // ['rt' => '001', 'rw' => '002', 'nama' => 'ZACHLUL BHAKTI', 'nik' => '3522151003700004', 'no_whatsapp' => '6282338497883'],
            // ['rt' => '002', 'rw' => '002', 'nama' => 'MOHAMMAD BUKHORI', 'nik' => '3522152904680002', 'no_whatsapp' => '6281331431460'],
            // ['rt' => '003', 'rw' => '002', 'nama' => 'DJOKO SUSENO', 'nik' => '3522151005730005', 'no_whatsapp' => '6282332622102'],
            // ['rt' => '004', 'rw' => '002', 'nama' => 'MOCH.AFFANDI', 'nik' => '3522152007520003', 'no_whatsapp' => '6285331411443'],
            // ['rt' => '005', 'rw' => '002', 'nama' => 'FAHRUDIN', 'nik' => '3522150203830002', 'no_whatsapp' => '6283839008418'],
            // ['rt' => '006', 'rw' => '002', 'nama' => 'RAMELAN', 'nik' => '3522151209610003', 'no_whatsapp' => '6289531838072'],
            // ['rt' => '007', 'rw' => '002', 'nama' => 'MOCH. BUDIONO', 'nik' => '3577022808700002', 'no_whatsapp' => '6281553591857'],
            // ['rt' => '001', 'rw' => '003', 'nama' => 'AGUS SUPRIYANTO', 'nik' => '3522150509890005', 'no_whatsapp' => '6285334922339'],
            // ['rt' => '002', 'rw' => '003', 'nama' => 'SUGIANTO', 'nik' => '3522151003660007', 'no_whatsapp' => '6285230125532'],
            // ['rt' => '003', 'rw' => '003', 'nama' => 'SUNARTO', 'nik' => '3522153103780002', 'no_whatsapp' => '6285233912808'],
            // ['rt' => '004', 'rw' => '003', 'nama' => 'SOEPARDI', 'nik' => '3522151006740010', 'no_whatsapp' => '6281230332208'],
            // ['rt' => '005', 'rw' => '003', 'nama' => 'ARI NUR CAHYO', 'nik' => '3522151406900003', 'no_whatsapp' => '6285749996089'],
            // ['rt' => '006', 'rw' => '003', 'nama' => 'HERMAN', 'nik' => '3522152011770006', 'no_whatsapp' => '6285730075358'],
            // ['rt' => '001', 'rw' => '004', 'nama' => 'KUSTONO', 'nik' => '3522151912600006', 'no_whatsapp' => '6282257531960'],
            // ['rt' => '002', 'rw' => '004', 'nama' => 'BANIN AFFANDI', 'nik' => '3522151805810005', 'no_whatsapp' => '6285235741118'],
            // ['rt' => '003', 'rw' => '004', 'nama' => 'SUKIRMAN', 'nik' => '3522152112710002', 'no_whatsapp' => '6285330207940'],
            // ['rt' => '004', 'rw' => '004', 'nama' => 'AGUS SETIONO', 'nik' => '3522151308940002', 'no_whatsapp' => '6281547207850'],
            // ['rt' => '001', 'rw' => '005', 'nama' => 'EKO MEI ADI SANTOSO', 'nik' => '3522150105650008', 'no_whatsapp' => '6281357740287'],
            // ['rt' => '002', 'rw' => '005', 'nama' => 'WIWIEK IDHAYANTI', 'nik' => '3522156103670009', 'no_whatsapp' => '6281233572277'],
            // ['rt' => '003', 'rw' => '005', 'nama' => 'PUGUH MINTARJO, S. Pd', 'nik' => '3522151012630010', 'no_whatsapp' => '6281330499417'],
            // ['rt' => '004', 'rw' => '005', 'nama' => 'AGUNG KUNCORO', 'nik' => '3522150805790006', 'no_whatsapp' => '62895401918342'],
            // ['rt' => '001', 'rw' => '006', 'nama' => 'HARIYANTO', 'nik' => '3522150701650005', 'no_whatsapp' => '6281216259445'],
            // ['rt' => '002', 'rw' => '006', 'nama' => 'RONY BACHTIAR', 'nik' => '3522152103820003', 'no_whatsapp' => '6287856322202'],
            // ['rt' => '003', 'rw' => '006', 'nama' => 'Ir. DANIEL FERDIANTA', 'nik' => '3522150807660001', 'no_whatsapp' => '6282142163667'],
            // ['rt' => '004', 'rw' => '006', 'nama' => 'ARDHI PRIAMBODO', 'nik' => '3522151505640004', 'no_whatsapp' => '6285855630199'],
            // ['rt' => '005', 'rw' => '006', 'nama' => 'SUTAJI', 'nik' => '3522151103600005', 'no_whatsapp' => '6282143223119'],
            ['rt' => '111', 'rw' => '111', 'nama' => 'Tsabit', 'nik' => '3522151103600004', 'no_whatsapp' => '6281259744980'],

        ];

        foreach ($ketuaRtList as $data) {
            KetuaRt::updateOrCreate(
                ['nik' => $data['nik']],
                $data
            );
        }
    }
}
