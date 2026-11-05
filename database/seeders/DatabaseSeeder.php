<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Product;
use App\Models\Rw;
use App\Models\Setting;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the first admin only when explicit credentials are configured.
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if (filled($adminEmail) xor filled($adminPassword)) {
            throw new \RuntimeException('Set both ADMIN_EMAIL and ADMIN_PASSWORD before seeding the admin account.');
        }

        if (filled($adminEmail) && filled($adminPassword)) {
            if (strlen($adminPassword) < 16) {
                throw new \RuntimeException('ADMIN_PASSWORD must contain at least 16 characters.');
            }

            User::firstOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => env('ADMIN_NAME', 'Administrator RW'),
                    'password' => Hash::make($adminPassword),
                ]
            );
        }

        // 2. Settings
        Setting::getSettings();

        // 3. RW Data
        $rw1 = Rw::updateOrCreate(
            ['slug' => 'rw-01'],
            [
                'nomor_rw' => 'RW 01',
                'nama' => 'RW 01 Suryodiningratan',
                'deskripsi' => 'Rukun Warga 01 berada di kawasan dengan denyut kuliner rumahan dan industri kreatif yang semarak. Warga aktif mengembangkan berbagai olahan pangan tradisional bermutu tinggi dan ramah lingkungan.',
                'potensi_kegiatan' => 'Potensi utama meliputi kuliner khas rumahan, bank sampah mandiri, kebun gizi RT, dan kerja bakti rutin tiap minggu pagi.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1200&q=80',
                'foto_galeri' => [
                    'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80',
                ],
                'nama_ketua_rw' => 'H. Bambang Sugiarto',
                'kontak_ketua_rw' => '081234567801',
                'is_leader_public' => true,
                'status' => 'terbit',
            ]
        );

        $rw2 = Rw::updateOrCreate(
            ['slug' => 'rw-02'],
            [
                'nomor_rw' => 'RW 02',
                'nama' => 'RW 02 Sinduharjo',
                'deskripsi' => 'Terkenal dengan pelestarian jamu gendong warisan leluhur dan sentra kerajinan batik pewarna alami. Memiliki komunitas ibu rumah tangga yang produktif.',
                'potensi_kegiatan' => 'Sentra pembuatan jamu tradisional higienis, kerajinan kain perca & batik tulis, serta posyandu lansia teladan tingkat kota.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=1200&q=80',
                'foto_galeri' => [
                    'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?auto=format&fit=crop&w=800&q=80',
                ],
                'nama_ketua_rw' => 'Dra. Hj. Siti Rahayu',
                'kontak_ketua_rw' => '081234567802',
                'is_leader_public' => true,
                'status' => 'terbit',
            ]
        );

        $rw3 = Rw::updateOrCreate(
            ['slug' => 'rw-03'],
            [
                'nomor_rw' => 'RW 03',
                'nama' => 'RW 03 Krajan Asri',
                'deskripsi' => 'Kawasan sejuk dengan tradisi perkebunan pekarangan, budidaya madu lebah klanceng, dan roastery kopi skala mikro yang digerakkan oleh pemuda karang taruna.',
                'potensi_kegiatan' => 'Roastery kopi lokal, budidaya madu tanpa sengat, hidroponik sayur organik, dan pelatihan digital marketing pemuda.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1200&q=80',
                'foto_galeri' => [
                    'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=800&q=80',
                ],
                'nama_ketua_rw' => 'Ahmad Fauzi, S.T.',
                'kontak_ketua_rw' => '081234567803',
                'is_leader_public' => false, // Hidden by permission
                'status' => 'terbit',
            ]
        );

        $rw4 = Rw::updateOrCreate(
            ['slug' => 'rw-04'],
            [
                'nomor_rw' => 'RW 04',
                'nama' => 'RW 04 Sukamaju Mandiri',
                'deskripsi' => 'Pusat kriya dan kerajinan tangan berbahan dasar bambu, ecoprint, serta aneka anyaman ramah lingkungan yang mengakar kuat pada kearifan lokal.',
                'potensi_kegiatan' => 'Sanggar kerajinan anyaman bambu, workshop ecoprint daun liar, festival dolanan tradisional, dan koperasi simpan pinjam warga.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80',
                'foto_galeri' => [],
                'nama_ketua_rw' => 'Agus Priyono',
                'kontak_ketua_rw' => '081234567804',
                'is_leader_public' => true,
                'status' => 'terbit',
            ]
        );

        // 4. UMKM Data
        $umkm1 = Umkm::updateOrCreate(
            ['slug' => 'kopi-seduh-krajan'],
            [
                'rw_id' => $rw3->id,
                'nama_usaha' => 'Kopi Seduh Krajan',
                'kategori' => 'Makanan & Minuman',
                'nama_pemilik' => 'Rian Pratama',
                'is_owner_public' => true,
                'deskripsi' => 'Roastery kopi rumahan yang mengkurasi biji kopi pilihan dari petani lereng terdekat, disangrai secara berkala untuk menjaga kesegaran rasa dan aroma autentik.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=80',
                'foto_galeri' => [
                    'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=800&q=80',
                ],
                'nomor_whatsapp' => '6281234567890',
                'pesan_whatsapp_template' => 'Halo, saya melihat profil Kopi Seduh Krajan di website. Saya ingin memesan biji kopi atau berkonsultasi mengenai produk Anda.',
                'jam_operasional' => 'Senin - Sabtu: 09.00 - 20.00 WIB',
                'tautan_sosmed' => 'https://instagram.com/kopikrajan',
                'alamat_spesifik' => 'Jl. Krajan Asri No. 18, RT 02 / RW 03',
                'is_unggulan' => true,
                'status' => 'terbit',
            ]
        );

        $umkm2 = Umkm::updateOrCreate(
            ['slug' => 'dapur-sambal-bu-warsi'],
            [
                'rw_id' => $rw1->id,
                'nama_usaha' => 'Dapur Sambal Bu Warsi',
                'kategori' => 'Makanan & Minuman',
                'nama_pemilik' => 'Ibu Warsini',
                'is_owner_public' => true,
                'deskripsi' => 'Pelopor aneka sambal kemasan higienis tanpa bahan pengawet kimia. Dibuat menggunakan cabai segar hasil kebun warga dengan resep turun-temurun sejak 1998.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=1000&q=80',
                'foto_galeri' => [],
                'nomor_whatsapp' => '6281398765432',
                'pesan_whatsapp_template' => 'Halo, saya tertarik dengan produk Dapur Sambal Bu Warsi di website. Mohon info ketersediaan varian sambal.',
                'jam_operasional' => 'Setiap Hari: 08.00 - 17.00 WIB',
                'tautan_sosmed' => 'https://instagram.com/sambalbuwarsi',
                'alamat_spesifik' => 'Gang Melati 3 No. 4, RT 01 / RW 01',
                'is_unggulan' => true,
                'status' => 'terbit',
            ]
        );

        $umkm3 = Umkm::updateOrCreate(
            ['slug' => 'batik-tulis-sekar-arum'],
            [
                'rw_id' => $rw2->id,
                'nama_usaha' => 'Batik Tulis Sekar Arum',
                'kategori' => 'Fesyen & Tekstil',
                'nama_pemilik' => 'Ibu Arum Kusuma',
                'is_owner_public' => true,
                'deskripsi' => 'Kolektif perajin batik tulis ibu-ibu RW 02 yang mengkhususkan diri pada pewarnaan alami dari kulit kayu mahoni, daun mangga, dan indigofera.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?auto=format&fit=crop&w=1000&q=80',
                'foto_galeri' => [],
                'nomor_whatsapp' => '6281223344556',
                'pesan_whatsapp_template' => 'Halo Ibu Arum, saya tertarik dengan kain batik tulis Sekar Arum yang tampil di web. Boleh kirim katalog motif?',
                'jam_operasional' => 'Senin - Jumat: 08.30 - 16.30 WIB',
                'tautan_sosmed' => 'https://instagram.com/batiksekararum',
                'alamat_spesifik' => 'Jl. Sindu Kenanga No. 12, RT 04 / RW 02',
                'is_unggulan' => true,
                'status' => 'terbit',
            ]
        );

        $umkm4 = Umkm::updateOrCreate(
            ['slug' => 'kerajinan-bambu-lestari'],
            [
                'rw_id' => $rw4->id,
                'nama_usaha' => 'Kerajinan Bambu Lestari',
                'kategori' => 'Kerajinan Tangan',
                'nama_pemilik' => 'Pak Daryono',
                'is_owner_public' => true,
                'deskripsi' => 'Usaha kerajinan anyaman bambu kontemporer yang memadukan teknik tradisional dengan desain minimalis untuk keperluan perlengkapan rumah dan dekorasi interior.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1000&q=80',
                'foto_galeri' => [],
                'nomor_whatsapp' => '6285712345678',
                'pesan_whatsapp_template' => 'Halo Pak Daryono, saya melihat kerajinan bambu Lestari di web RW. Saya ingin menanyakan ukuran dan pemesanan.',
                'jam_operasional' => 'Senin - Sabtu: 08.00 - 16.00 WIB',
                'tautan_sosmed' => 'https://instagram.com/bambulestari',
                'alamat_spesifik' => 'Dusun Sukamaju RT 03 / RW 04',
                'is_unggulan' => true,
                'status' => 'terbit',
            ]
        );

        $umkm5 = Umkm::updateOrCreate(
            ['slug' => 'jamu-warisan-mbok-minah'],
            [
                'rw_id' => $rw2->id,
                'nama_usaha' => 'Jamu Warisan Mbok Minah',
                'kategori' => 'Makanan & Minuman',
                'nama_pemilik' => 'Ibu Siti Aminah',
                'is_owner_public' => false,
                'deskripsi' => 'Racikan rempah segar empon-empon lokal tanpa pemanis buatan. Tersedia dalam kemasan botol kaca higienis siap minum untuk menjaga kebugaran alami.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=1000&q=80',
                'foto_galeri' => [],
                'nomor_whatsapp' => '6281987654321',
                'pesan_whatsapp_template' => 'Halo Mbok Minah, saya ingin memesan botol jamu segar hari ini.',
                'jam_operasional' => 'Setiap Hari: 06.00 - 14.00 WIB',
                'tautan_sosmed' => null,
                'alamat_spesifik' => 'RT 02 / RW 02 Sinduharjo',
                'is_unggulan' => false,
                'status' => 'terbit',
            ]
        );

        $umkm6 = Umkm::updateOrCreate(
            ['slug' => 'madu-murni-sari-bunga'],
            [
                'rw_id' => $rw3->id,
                'nama_usaha' => 'Madu Murni Sari Bunga',
                'kategori' => 'Pertanian & Perkebunan',
                'nama_pemilik' => 'Sujatmiko',
                'is_owner_public' => true,
                'deskripsi' => 'Budidaya lebah madu klanceng (Trigona) di pekarangan warga RW 03. Menghasilkan madu dengan rasa manis-asam segar berkhasiat tinggi untuk kekebalan tubuh.',
                'foto_sampul' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?auto=format&fit=crop&w=1000&q=80',
                'foto_galeri' => [],
                'nomor_whatsapp' => '6282133445566',
                'pesan_whatsapp_template' => 'Halo Mas Miko, saya ingin memesan madu klanceng asli dari RW 03.',
                'jam_operasional' => 'Senin - Sabtu: 08.00 - 17.00 WIB',
                'tautan_sosmed' => null,
                'alamat_spesifik' => 'RT 01 / RW 03 Krajan',
                'is_unggulan' => false,
                'status' => 'terbit',
            ]
        );

        // 5. Products Data
        Product::updateOrCreate(
            ['slug' => 'arabika-krajan-natural-200g'],
            [
                'umkm_id' => $umkm1->id,
                'nama_produk' => 'Biji Kopi Arabika Krajan Natural 200g',
                'deskripsi' => 'Single origin Arabika dengan proses fermentasi natural. Memiliki profil rasa buah tropis, keasaman manis sedang, dan aftertaste cokelat bersih.',
                'foto_produk' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?auto=format&fit=crop&w=800&q=80',
                'harga' => 75000,
                'status_ketersediaan' => 'tersedia',
                'is_unggulan' => true,
                'status' => 'terbit',
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'drip-bag-coffee-box-isi-5'],
            [
                'umkm_id' => $umkm1->id,
                'nama_produk' => 'Drip Bag Coffee Box (Isi 5 Sachet)',
                'deskripsi' => 'Kopi seduh praktis tanpa ampas. Cukup tuang air panas, siap dinikmati di rumah maupun saat bepergian.',
                'foto_produk' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=80',
                'harga' => 45000,
                'status_ketersediaan' => 'tersedia',
                'is_unggulan' => false,
                'status' => 'terbit',
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'sambal-bawang-cumi-asap-150g'],
            [
                'umkm_id' => $umkm2->id,
                'nama_produk' => 'Sambal Bawang Cumi Asap 150g',
                'deskripsi' => 'Perpaduan cumi asin asap gurih dengan cabai rawit pedas mantap dalam minyak kelapa murni. Tahan 2 bulan di suhu ruang.',
                'foto_produk' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=800&q=80',
                'harga' => 38000,
                'status_ketersediaan' => 'tersedia',
                'is_unggulan' => true,
                'status' => 'terbit',
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'sambal-roak-asli-manado-150g'],
            [
                'umkm_id' => $umkm2->id,
                'nama_produk' => 'Sambal Roa Asap Khas Bu Warsi',
                'deskripsi' => 'Dibuat dari ikan roa asap pilihan yang dihaluskan bersama bawang merah lokal dan rempah aromatik.',
                'foto_produk' => 'https://images.unsplash.com/photo-1505253758473-96b3015f240a?auto=format&fit=crop&w=800&q=80',
                'harga' => 42000,
                'status_ketersediaan' => 'tersedia',
                'is_unggulan' => false,
                'status' => 'terbit',
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'selendang-batik-pewarna-alam-mahoni'],
            [
                'umkm_id' => $umkm3->id,
                'nama_produk' => 'Selendang Batik Sutra Pewarna Mahoni',
                'deskripsi' => 'Selendang sutra halus dengan motif Sekar Jagad kontemporer. Diwarnai menggunakan ekstrak kulit mahoni dan dedaunan.',
                'foto_produk' => 'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?auto=format&fit=crop&w=800&q=80',
                'harga' => 285000,
                'status_ketersediaan' => 'pre_order',
                'is_unggulan' => true,
                'status' => 'terbit',
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'kap-lampu-anyaman-bambu-zen'],
            [
                'umkm_id' => $umkm4->id,
                'nama_produk' => 'Kap Lampu Gantung Anyaman Bambu Zen',
                'deskripsi' => 'Kap lampu estetis dengan siluet bundar organik. Menghasilkan pendar cahaya temaram yang hangat untuk ruang tamu atau cafe.',
                'foto_produk' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=800&q=80',
                'harga' => 145000,
                'status_ketersediaan' => 'tersedia',
                'is_unggulan' => true,
                'status' => 'terbit',
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'nampan-saji-bambu-minimalis'],
            [
                'umkm_id' => $umkm4->id,
                'nama_produk' => 'Nampan Saji Bambu Cendani',
                'deskripsi' => 'Nampan saji dengan aksen bambu cendani halus dilapisi beeswax food grade ramah lingkungan.',
                'foto_produk' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=800&q=80',
                'harga' => null, // Intentionally null to test price placeholder requirement!
                'status_ketersediaan' => 'tersedia',
                'is_unggulan' => false,
                'status' => 'terbit',
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'jamu-kunyit-asam-segar-500ml'],
            [
                'umkm_id' => $umkm5->id,
                'nama_produk' => 'Kunyit Asam Segar Botol Kaca 500ml',
                'deskripsi' => 'Kunyit biang segar dipadukan dengan asam jawa tua dan gula aren murni. Tanpa endapan pahit.',
                'foto_produk' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=800&q=80',
                'harga' => 20000,
                'status_ketersediaan' => 'tersedia',
                'is_unggulan' => false,
                'status' => 'terbit',
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'madu-klanceng-trigona-murni-250ml'],
            [
                'umkm_id' => $umkm6->id,
                'nama_produk' => 'Madu Klanceng Trigona Raw Honey 250ml',
                'deskripsi' => 'Madu mentah tanpa proses pasteurisasi berlebih sehingga kandungan enzim dan propolis alami tetap utuh terjaga.',
                'foto_produk' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?auto=format&fit=crop&w=800&q=80',
                'harga' => 120000,
                'status_ketersediaan' => 'tersedia',
                'is_unggulan' => false,
                'status' => 'terbit',
            ]
        );

        // 6. Articles / Stories
        Article::updateOrCreate(
            ['slug' => 'menghidupkan-tradisi-jamu-gendong-era-modern'],
            [
                'judul' => 'Menghidupkan Tradisi Jamu Gendong di Tengah Era Minuman Kemasan',
                'kategori' => 'Kisah UMKM',
                'ringkasan' => 'Bagaimana para perajin jamu di RW 02 beradaptasi dengan kemasan kaca higienis dan kanal pemesanan digital tanpa melupakan pakem resep leluhur.',
                'konten' => '<p>Di sebuah sudut RW 02 Sinduharjo, wangi kunyit yang direbus dan aroma asam jawa yang pekat selalu menyapa setiap pagi menjelang pukul lima. Di sanalah Mbok Minah bersama kelompok ibu-ibu warga mengolah empon-empon segar kiriman petani binaan.</p><p>Ketika gaya hidup sehat kian diminati anak-anak muda, kelompok usaha jamu di RW ini melihat peluang besar. Melalui pendampingan warga dan pemuda setempat, kemasan jamu kini diperbarui dengan botol kaca bersegel rapi dan label minimalis yang informatif.</p><p>“Bukan hanya soal menjual minuman sehat, tapi menjaga agar anak cucu kita paham bahwa bumi pertiwi kita punya ramuan herbal yang luar biasa khasiatnya,” ujar Mbok Minah dengan senyum bangga saat ditemui di kediamannya.</p>',
                'foto_sampul' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=1200&q=80',
                'tanggal_publikasi' => now()->subDays(2),
                'status' => 'terbit',
            ]
        );

        Article::updateOrCreate(
            ['slug' => 'kreasi-bambu-sukamaju-tembus-pasar-nasional'],
            [
                'judul' => 'Dari Rumpun Bambu Belakang Rumah Menjadi Dekorasi Interior Bernilai Tinggi',
                'kategori' => 'Potensi Wilayah',
                'ringkasan' => 'Melihat dedikasi perajin bambu RW 04 yang mengubah batang bambu sederhana menjadi kap lampu dan perabot estetis berkarakter kontemporer.',
                'konten' => '<p>Bambu seringkali dipandang sebagai material murah dan rapuh. Namun di tangan para perajin RW 04 Sukamaju Mandiri, serat-serat bambu dianyam dengan ketelitian milimeter hingga melahirkan produk berkelas galeri.</p><p>Pak Daryono, salah satu perintis bengkel bambu warga, menceritakan proses perendaman dan pengasapan bambu alami agar tahan rayap hingga puluhan tahun. Produk-produk ini kini kerap menghiasi kedai kopi modern, villa di Bali, hingga rumah-rumah berkonsep Japandi di berbagai kota besar.</p><p>Inisiatif ini membuktikan bahwa potensi lokal di tingkat rukun warga memiliki daya saing yang sangat tinggi ketika dikemas dengan visi desain yang kuat.</p>',
                'foto_sampul' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80',
                'tanggal_publikasi' => now()->subDays(5),
                'status' => 'terbit',
            ]
        );

        Article::updateOrCreate(
            ['slug' => 'kopi-seduh-krajan-dan-geliat-pemuda-karang-taruna'],
            [
                'judul' => 'Karang Taruna RW 03 Merintis Roastery Mikro dan Menggerakkan Ekonomi Warga',
                'kategori' => 'Kegiatan Warga',
                'ringkasan' => 'Ruang temu pemuda yang disulap menjadi roastery kopi mandiri, membuktikan peran generasi muda dalam memajukan lingkungan rukun warga.',
                'konten' => '<p>Berawal dari obrolan santai seusai kerja bakti malam minggu, para pemuda di RW 03 Krajan Asri bersepakat memanfaatkan garasi kosong milik salah satu warga menjadi roastery kopi kecil-kecilan.</p><p>Dengan modal iuran warga dan ketekunan belajar sangrai kopi dari barista profesional, Kopi Seduh Krajan kini menjadi kebanggaan lingkungan. Setiap akhir pekan, warga dan tamu dari luar lingkungan berkumpul di balai warga untuk menikmati seduhan kopi sambil mendiskusikan program lingkungan.</p>',
                'foto_sampul' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1200&q=80',
                'tanggal_publikasi' => now()->subDays(9),
                'status' => 'terbit',
            ]
        );
    }
}
