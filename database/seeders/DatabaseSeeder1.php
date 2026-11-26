<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // ---------------------------------------------------------
        // 1. USERS (kolom role dari migration add_role_to_users_table)
        // ---------------------------------------------------------
        DB::table('users')->insert([
            [
                'name' => 'Admin Laundry',
                'email' => 'admin@laundry.test',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@laundry.test',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@laundry.test',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // ---------------------------------------------------------
        // 2. DETERJENS
        // ---------------------------------------------------------
        DB::table('deterjens')->insert([
            ['merek' => 'Rinso', 'jenis' => 'Bubuk', 'supplier' => 'PT Sumber Makmur', 'tanggal_pembelian' => '2026-10-01', 'stok' => 50],
            ['merek' => 'Attack', 'jenis' => 'Bubuk', 'supplier' => 'CV Berkah Jaya', 'tanggal_pembelian' => '2026-10-05', 'stok' => 40],
            ['merek' => 'So Klin', 'jenis' => 'Cair', 'supplier' => 'PT Sumber Makmur', 'tanggal_pembelian' => '2026-10-10', 'stok' => 35],
            ['merek' => 'Daia', 'jenis' => 'Bubuk', 'supplier' => 'UD Sejahtera', 'tanggal_pembelian' => '2026-10-12', 'stok' => 60],
            ['merek' => 'Molto', 'jenis' => 'Pelembut', 'supplier' => 'CV Berkah Jaya', 'tanggal_pembelian' => '2026-10-15', 'stok' => 45],
            ['merek' => 'Downy', 'jenis' => 'Pelembut', 'supplier' => 'PT Mitra Abadi', 'tanggal_pembelian' => '2026-10-20', 'stok' => 30],
            ['merek' => 'Superpell', 'jenis' => 'Pembersih Lantai', 'supplier' => 'UD Sejahtera', 'tanggal_pembelian' => '2026-10-22', 'stok' => 20],
            ['merek' => 'Bayclin', 'jenis' => 'Pemutih', 'supplier' => 'PT Mitra Abadi', 'tanggal_pembelian' => '2026-11-02', 'stok' => 25],
            ['merek' => 'Soklin Softergent', 'jenis' => 'Cair', 'supplier' => 'PT Sumber Makmur', 'tanggal_pembelian' => '2026-11-08', 'stok' => 38],
            ['merek' => 'Surf', 'jenis' => 'Bubuk', 'supplier' => 'CV Berkah Jaya', 'tanggal_pembelian' => '2026-11-14', 'stok' => 55],
        ]);

        // created_at / updated_at untuk deterjens
        DB::table('deterjens')->update(['created_at' => $now, 'updated_at' => $now]);

        // ---------------------------------------------------------
        // 3. DATAPELANGGAN (tanpa timestamps)
        // ---------------------------------------------------------
        DB::table('datapelanggan')->insert([
            ['nama' => 'Andi Pratama', 'alamat' => 'Jl. Soekarno Hatta No. 12, Bandung', 'notelp' => '081234567801', 'catatan' => 'Pelanggan tetap, minta lipat rapi'],
            ['nama' => 'Rina Wulandari', 'alamat' => 'Jl. Bojongsoang No. 45, Bandung', 'notelp' => '081234567802', 'catatan' => null],
            ['nama' => 'Dedi Kurniawan', 'alamat' => 'Perumahan Citra Residence Blok B3, Bandung', 'notelp' => '081234567803', 'catatan' => 'Alergi pewangi kuat'],
            ['nama' => 'Maya Sari', 'alamat' => 'Jl. Telekomunikasi No. 7, Bandung', 'notelp' => '081234567804', 'catatan' => 'Antar jemput'],
            ['nama' => 'Fajar Nugroho', 'alamat' => 'Jl. Radio Palasari No. 21, Bandung', 'notelp' => '081234567805', 'catatan' => null],
            ['nama' => 'Lestari Dewi', 'alamat' => 'Kos Putri Melati, Jl. Dayeuhkolot No. 9', 'notelp' => '081234567806', 'catatan' => 'Mahasiswa, cuci kiloan mingguan'],
            ['nama' => 'Hendra Gunawan', 'alamat' => 'Jl. Mohammad Toha No. 88, Bandung', 'notelp' => '081234567807', 'catatan' => 'Sering order express'],
            ['nama' => 'Nur Aisyah', 'alamat' => 'Jl. Sukapura No. 15, Bandung', 'notelp' => '081234567808', 'catatan' => null],
            ['nama' => 'Rizal Firmansyah', 'alamat' => 'Jl. Buah Batu No. 101, Bandung', 'notelp' => '081234567809', 'catatan' => 'Bedcover dan selimut'],
            ['nama' => 'Putri Anjani', 'alamat' => 'Apartemen Skyline Lt. 5 No. 12, Bandung', 'notelp' => '081234567810', 'catatan' => 'Setrika saja'],
        ]);

        // ---------------------------------------------------------
        // 4. LAYANAN
        // ---------------------------------------------------------
        DB::table('layanan')->insert([
            ['id_layanan' => 1, 'kategori' => 'Kiloan', 'nama_layanan' => 'Cuci Kering Lipat', 'minimal_kg' => 3.00],
            ['id_layanan' => 2, 'kategori' => 'Kiloan', 'nama_layanan' => 'Cuci Setrika', 'minimal_kg' => 3.00],
            ['id_layanan' => 3, 'kategori' => 'Kiloan', 'nama_layanan' => 'Setrika Saja', 'minimal_kg' => 3.00],
            ['id_layanan' => 4, 'kategori' => 'Satuan', 'nama_layanan' => 'Cuci Bedcover', 'minimal_kg' => 0.00],
            ['id_layanan' => 5, 'kategori' => 'Satuan', 'nama_layanan' => 'Cuci Selimut', 'minimal_kg' => 0.00],
            ['id_layanan' => 6, 'kategori' => 'Satuan', 'nama_layanan' => 'Cuci Sepatu', 'minimal_kg' => 0.00],
            ['id_layanan' => 7, 'kategori' => 'Premium', 'nama_layanan' => 'Dry Cleaning', 'minimal_kg' => 1.00],
            ['id_layanan' => 8, 'kategori' => 'Express', 'nama_layanan' => 'Cuci Setrika Express', 'minimal_kg' => 2.00],
        ]);

        // ---------------------------------------------------------
        // 5. TARIF (FK ke layanan.id_layanan)
        // ---------------------------------------------------------
        DB::table('tarif')->insert([
            ['id_layanan' => 1, 'nama_paket' => 'Reguler', 'harga' => 6000, 'estimasi_waktu' => '2-3 hari'],
            ['id_layanan' => 1, 'nama_paket' => 'Kilat', 'harga' => 9000, 'estimasi_waktu' => '1 hari'],
            ['id_layanan' => 2, 'nama_paket' => 'Reguler', 'harga' => 8000, 'estimasi_waktu' => '2-3 hari'],
            ['id_layanan' => 2, 'nama_paket' => 'Kilat', 'harga' => 12000, 'estimasi_waktu' => '1 hari'],
            ['id_layanan' => 3, 'nama_paket' => 'Reguler', 'harga' => 5000, 'estimasi_waktu' => '1-2 hari'],
            ['id_layanan' => 4, 'nama_paket' => 'Single', 'harga' => 35000, 'estimasi_waktu' => '3 hari'],
            ['id_layanan' => 4, 'nama_paket' => 'Double/King', 'harga' => 50000, 'estimasi_waktu' => '3 hari'],
            ['id_layanan' => 5, 'nama_paket' => 'Standar', 'harga' => 25000, 'estimasi_waktu' => '2-3 hari'],
            ['id_layanan' => 6, 'nama_paket' => 'Standar', 'harga' => 30000, 'estimasi_waktu' => '3 hari'],
            ['id_layanan' => 7, 'nama_paket' => 'Jas/Blazer', 'harga' => 40000, 'estimasi_waktu' => '3-4 hari'],
            ['id_layanan' => 7, 'nama_paket' => 'Gaun', 'harga' => 60000, 'estimasi_waktu' => '4-5 hari'],
            ['id_layanan' => 8, 'nama_paket' => 'Express 6 Jam', 'harga' => 20000, 'estimasi_waktu' => '6 jam'],
        ]);

        // ---------------------------------------------------------
        // 6. MESIN
        // ---------------------------------------------------------
        DB::table('mesin')->insert([
            ['nama' => 'Mesin Cuci 1', 'merek' => 'LG', 'kapasitas' => '10 kg', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Mesin Cuci 2', 'merek' => 'Samsung', 'kapasitas' => '8 kg', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Mesin Cuci 3', 'merek' => 'Sharp', 'kapasitas' => '12 kg', 'status' => 'maintenance', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Mesin Pengering 1', 'merek' => 'Electrolux', 'kapasitas' => '10 kg', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Mesin Pengering 2', 'merek' => 'Panasonic', 'kapasitas' => '8 kg', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Setrika Uap 1', 'merek' => 'Philips', 'kapasitas' => '2 liter', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Setrika Uap 2', 'merek' => 'Philips', 'kapasitas' => '2 liter', 'status' => 'rusak', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
