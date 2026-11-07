<?php

namespace App\Services;

use App\Repositories\ProduksiRepository;
use App\Models\BahanBaku;
use App\Models\StokSoun;
use App\Models\TransaksiBahanBaku;
use App\Models\TransaksiSoun;
use Illuminate\Support\Facades\DB;
use Exception;

class ProduksiService
{
    protected $produksiRepository;

    public function __construct(ProduksiRepository $produksiRepository)
    {
        $this->produksiRepository = $produksiRepository;
    }

    public function catatProduksiBaru(array $data)
    {
        DB::beginTransaction();
        try {
            $total_biaya_produksi = 0;
            $bahanBakusData = [];
            
            $kaliProduksi = $data['kali_produksi'] ?? 1;

            // Kebutuhan bahan baku untuk 1x produksi
            $kebutuhan = [
                1 => 2100 * $kaliProduksi, // Tepung Pati Aren
                2 => 28 * $kaliProduksi,   // Kaporit
                3 => 50 * $kaliProduksi,   // Minyak Kelapa Sawit
                4 => 10 * $kaliProduksi    // Kayu Bakar
            ];

            // 1. Validasi & Hitung biaya bahan baku
            foreach ($kebutuhan as $bahan_baku_id => $jumlah_digunakan) {
                $bahanBaku = BahanBaku::lockForUpdate()->findOrFail($bahan_baku_id);
                if ($bahanBaku->stok < $jumlah_digunakan) {
                    throw new Exception('Stok bahan baku ' . $bahanBaku->nama . ' tidak mencukupi (Butuh: ' . $jumlah_digunakan . ' ' . $bahanBaku->satuan . ').');
                }
                
                $biaya = $jumlah_digunakan * $bahanBaku->harga_beli_satuan;
                $total_biaya_produksi += $biaya;
                
                $bahanBakusData[] = [
                    'model' => $bahanBaku,
                    'jumlah_digunakan' => $jumlah_digunakan,
                    'biaya' => $biaya
                ];
            }
            
            // 1x produksi = 1900 kg
            $total_kg = 1900 * $kaliProduksi;
            $total_gram = $total_kg * 1000;

            // 3. Simpan produksi utama
            $produksiData = [
                'tanggal_produksi' => $data['tanggal_produksi'],
                'total_biaya_produksi' => $total_biaya_produksi,
                'total_gram' => $total_gram,
                'catatan' => $data['catatan'] ?? null,
            ];
            
            $produksi = $this->produksiRepository->create($produksiData);

            // 4. Kurangi stok bahan baku & catat detail + transaksi
            foreach ($bahanBakusData as $item) {
                $bahanBaku = $item['model'];
                $bahanBaku->stok -= $item['jumlah_digunakan'];
                $bahanBaku->save();

                \App\Models\ProduksiDetail::create([
                    'produksi_id' => $produksi->id,
                    'bahan_baku_id' => $bahanBaku->id,
                    'jumlah_digunakan' => $item['jumlah_digunakan'],
                    'biaya' => $item['biaya']
                ]);

                TransaksiBahanBaku::create([
                    'bahan_baku_id' => $bahanBaku->id,
                    'jenis' => 'keluar',
                    'jumlah' => $item['jumlah_digunakan'],
                    'tanggal' => $data['tanggal_produksi'],
                    'keterangan' => 'Digunakan untuk produksi #' . $produksi->id
                ]);
            }

            // 5. Tambah stok soun jadi
            $stokSoun = StokSoun::firstOrCreate(['id' => 1]);
            $stokSoun->stok_kg += $total_kg;
            $stokSoun->save();

            // Catat Transaksi Masuk Soun
            TransaksiSoun::create([
                'jenis' => 'masuk',
                'jumlah_kg' => $total_kg,
                'tanggal' => $data['tanggal_produksi'],
                'keterangan' => 'Hasil produksi #' . $produksi->id . ' (' . $total_kg . ' kg)'
            ]);

            DB::commit();
            return $produksi;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
