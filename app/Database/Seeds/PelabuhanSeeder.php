<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelabuhanSeeder extends Seeder
{
    public function run()
    {
        $dataPelabuhan = [
            ['nama_pelabuhan' => 'Adonara', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0555_Adonara.json'],
            ['nama_pelabuhan' => 'Ahmad Yani, Ternate', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0257_Ahmad%20Yani,%20Ternate.json'],
            ['nama_pelabuhan' => 'Aimere', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0399_Aimere.json'],
            ['nama_pelabuhan' => 'Amahai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0269_Amahai.json'],
            ['nama_pelabuhan' => 'Amolengo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0463_Amolengo.json'],
            ['nama_pelabuhan' => 'Amurang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0464_Amurang.json'],
            ['nama_pelabuhan' => 'Arar', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0452_Arar.json'],
            ['nama_pelabuhan' => 'ASDP Bakauheni', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0371_ASDP%20Bakauheni.json'],
            ['nama_pelabuhan' => 'ASDP Gilimanuk', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0170_ASDP%20Gilimanuk.json'],
            ['nama_pelabuhan' => 'ASDP Ketapang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0164_ASDP%20Ketapang.json'],
            ['nama_pelabuhan' => 'ASDP Merak', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0370_ASDP%20Merak.json'],
            ['nama_pelabuhan' => 'Asem Doyong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0588_Asem%20Doyong.json'],
            ['nama_pelabuhan' => 'Atapupu', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0187_Atapupu.json'],
            ['nama_pelabuhan' => 'Babang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0438_Babang.json'],
            ['nama_pelabuhan' => 'Babo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0458_Babo.json'],
            ['nama_pelabuhan' => 'Bajoe', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0215_Bajoe.json'],
            ['nama_pelabuhan' => 'Balauring', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0554_Balauring.json'],
            ['nama_pelabuhan' => 'Banda Neira', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0267_Banda%20Neira.json'],
            ['nama_pelabuhan' => 'Banggai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0224_Banggai.json'],
            ['nama_pelabuhan' => 'Bangsalae', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0500_Bangsalae.json'],
            ['nama_pelabuhan' => 'Baranusa, Alor', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0183_Baranusa,%20Alor.json'],
            ['nama_pelabuhan' => 'Bastiong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0431_Bastiong.json'],
            ['nama_pelabuhan' => 'Batang Dua', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0439_Batang%20Dua.json'],
            ['nama_pelabuhan' => 'Batu Ampar', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0014_Batu%20Ampar.json'],
            ['nama_pelabuhan' => 'Baubau', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0232_Baubau.json'],
            ['nama_pelabuhan' => 'Belawan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0001_Belawan.json'],
            ['nama_pelabuhan' => 'Benoa, Bali', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0165_Benoa,%20Bali.json'],
            ['nama_pelabuhan' => 'Biak', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0013_Biak.json'],
            ['nama_pelabuhan' => 'Bima, NTB', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0173_Bima,%20NTB.json'],
            ['nama_pelabuhan' => 'Bira', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0530_Bira.json'],
            ['nama_pelabuhan' => 'Biringkasi', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0219_Biringkasi.json'],
            ['nama_pelabuhan' => 'Bobong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0586_Bobong.json'],
            ['nama_pelabuhan' => 'Bojonegara', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0116_Bojonegara.json'],
            ['nama_pelabuhan' => 'Bolok', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0398_Bolok.json'],
            ['nama_pelabuhan' => 'Buli', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0582_Buli.json'],
            ['nama_pelabuhan' => 'Busua', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0570_Busua.json'],
            ['nama_pelabuhan' => 'Calang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0493_Calang.json'],
            ['nama_pelabuhan' => 'Celukan Bawang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0168_Celukan%20Bawang.json'],
            ['nama_pelabuhan' => 'Cirebon', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0107_Cirebon.json'],
            ['nama_pelabuhan' => 'Cituis Rawa Saban', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0533_Cituis%20Rawa%20Saban.json'],
            ['nama_pelabuhan' => 'Ciwandan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0480_Ciwandan.json'],
            ['nama_pelabuhan' => 'Daruba-Morotai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0448_Daruba-Morotai.json'],
            ['nama_pelabuhan' => 'Dermaga Usaha Mina', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0456_Dermaga%20Usaha%20Mina.json'],
            ['nama_pelabuhan' => 'Dobo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0272_Dobo.json'],
            ['nama_pelabuhan' => 'Dongkala', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0414_Dongkala.json'],
            ['nama_pelabuhan' => 'Dwikora', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0009_Dwikora.json'],
            ['nama_pelabuhan' => 'Ende, Flores', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0550_Ende,%20Flores.json'],
            ['nama_pelabuhan' => 'Fak-fak', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0292_Fak-fak.json'],
            ['nama_pelabuhan' => 'Ferry Batam Centre International', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0441_Ferry%20Batam%20Centre%20International.json'],
            ['nama_pelabuhan' => 'Ferry Harbour Bay', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0082_Ferry%20Harbour%20Bay.json'],
            ['nama_pelabuhan' => 'Galesong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0499_Galesong.json'],
            ['nama_pelabuhan' => 'Garongkong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0387_Garongkong.json'],
            ['nama_pelabuhan' => 'Gebe', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0583_Gebe.json'],
            ['nama_pelabuhan' => 'Gorontalo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0245_Gorontalo.json'],
            ['nama_pelabuhan' => 'Gresik', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0151_Gresik.json'],
            ['nama_pelabuhan' => 'Gunung Sitoli', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0027_Gunung%20Sitoli.json'],
            ['nama_pelabuhan' => 'Hansisi', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0552_Hansisi.json'],
            ['nama_pelabuhan' => 'Idi', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0492_Idi.json'],
            ['nama_pelabuhan' => 'Indah Kiat', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0485_Indah%20Kiat.json'],
            ['nama_pelabuhan' => 'Indari', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0571_Indari.json'],
            ['nama_pelabuhan' => 'Internasional Tanjung Balai Karimun', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0534_Internasional%20Tanjung%20Balai%20Karimun.json'],
            ['nama_pelabuhan' => 'Jangkar', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0524_Jangkar.json'],
            ['nama_pelabuhan' => 'Jayapura', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0278_Jayapura.json'],
            ['nama_pelabuhan' => 'Jepara', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0128_Jepara.json'],
            ['nama_pelabuhan' => 'Kadatua', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0579_Kadatua.json'],
            ['nama_pelabuhan' => 'Kalabahi', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0188_Kalabahi.json'],
            ['nama_pelabuhan' => 'Kalianget', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0154_Kalianget.json'],
            ['nama_pelabuhan' => 'Kalibaru', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0104_Kalibaru.json'],
            ['nama_pelabuhan' => 'Kamaru', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0581_Kamaru.json'],
            ['nama_pelabuhan' => 'Karimun Jawa', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0129_Karimun%20Jawa.json'],
            ['nama_pelabuhan' => 'Karingau', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0419_Karingau.json'],
            ['nama_pelabuhan' => 'Kasipute', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0573_Kasipute.json'],
            ['nama_pelabuhan' => 'Kayangan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0568_Kayangan.json'],
            ['nama_pelabuhan' => 'Kayoa', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0432_Kayoa.json'],
            ['nama_pelabuhan' => 'Kendari', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0011_Kendari.json'],
            ['nama_pelabuhan' => 'Kendawangan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0092_Kendawangan.json'],
            ['nama_pelabuhan' => 'Khusus Bea Cukai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0536_Khusus%20Bea%20Cukai.json'],
            ['nama_pelabuhan' => 'Kijing International Port', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0587_Kijing%20International%20Port.json'],
            ['nama_pelabuhan' => 'Klademak', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0428_Klademak.json'],
            ['nama_pelabuhan' => 'Kokas', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0297_Kokas.json'],
            ['nama_pelabuhan' => 'Kolaka', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0409_Kolaka.json'],
            ['nama_pelabuhan' => 'Kolonodale', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0225_Kolonodale.json'],
            ['nama_pelabuhan' => 'Kota Agung', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0119_Kota%20Agung.json'],
            ['nama_pelabuhan' => 'Krui', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0450_Krui.json'],
            ['nama_pelabuhan' => 'Kuala Maras', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0472_Kuala%20Maras.json'],
            ['nama_pelabuhan' => 'Kuala Tanjung', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0491_Kuala%20Tanjung.json'],
            ['nama_pelabuhan' => 'Kumai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0142_Kumai.json'],
            ['nama_pelabuhan' => 'Kupal', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0569_Kupal.json'],
            ['nama_pelabuhan' => 'Labuan Bajo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0182_Labuan%20Bajo.json'],
            ['nama_pelabuhan' => 'Labuan, Buton Utara', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0572_Labuan,%20Buton%20Utara.json'],
            ['nama_pelabuhan' => 'Langara', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0231_Langara.json'],
            ['nama_pelabuhan' => 'Larangan Tegal', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0590_Larangan%20Tegal.json'],
            ['nama_pelabuhan' => 'Larantuka', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0191_Larantuka.json'],
            ['nama_pelabuhan' => 'Lembar', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0172_Lembar.json'],
            ['nama_pelabuhan' => 'Letung', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0471_Letung.json'],
            ['nama_pelabuhan' => 'Lewoleba', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0401_Lewoleba.json'],
            ['nama_pelabuhan' => 'Likupang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0465_Likupang.json'],
            ['nama_pelabuhan' => 'Lirung', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0252_Lirung.json'],
            ['nama_pelabuhan' => 'Logending', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0591_Logending.json'],
            ['nama_pelabuhan' => 'Lok Tuan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0200_Lok%20Tuan.json'],
            ['nama_pelabuhan' => 'Luwuk', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0417_Luwuk.json'],
            ['nama_pelabuhan' => 'Malahayati', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0016_Malahayati.json'],
            ['nama_pelabuhan' => 'Manado', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0250_Manado.json'],
            ['nama_pelabuhan' => 'Manokwari', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0284_Manokwari.json'],
            ['nama_pelabuhan' => 'Marina Tanjung Lesung', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0528_Marina%20Tanjung%20Lesung.json'],
            ['nama_pelabuhan' => 'Marunda', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0102_Marunda.json'],
            ['nama_pelabuhan' => 'Maumere', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0551_Maumere.json'],
            ['nama_pelabuhan' => 'Mawasangka', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0416_Mawasangka.json'],
            ['nama_pelabuhan' => 'Merauke', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0286_Merauke.json'],
            ['nama_pelabuhan' => 'Mesuji', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0121_Mesuji.json'],
            ['nama_pelabuhan' => 'Midai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0476_Midai.json'],
            ['nama_pelabuhan' => 'Misool', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0459_Misool.json'],
            ['nama_pelabuhan' => 'Morodemak', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0333_Morodemak.json'],
            ['nama_pelabuhan' => 'Muara Angke', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0105_Muara%20Angke.json'],
            ['nama_pelabuhan' => 'Muara Sabak', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0539_Muara%20Sabak.json'],
            ['nama_pelabuhan' => 'Muara Sampara', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0501_Muara%20Sampara.json'],
            ['nama_pelabuhan' => 'Nabire', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0281_Nabire.json'],
            ['nama_pelabuhan' => 'Namlea', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0268_Namlea.json'],
            ['nama_pelabuhan' => 'Nunukan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0237_Nunukan.json'],
            ['nama_pelabuhan' => 'Nusa Penida', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0169_Nusa%20Penida.json'],
            ['nama_pelabuhan' => 'Padang Tikar', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0529_Padang%20Tikar.json'],
            ['nama_pelabuhan' => 'Padangbai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0167_Padangbai.json'],
            ['nama_pelabuhan' => 'Pamamata', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0405_Pamamata.json'],
            ['nama_pelabuhan' => 'Pamamata, Selayar', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0531_Pamamata,%20Selayar.json'],
            ['nama_pelabuhan' => 'Pananaru', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0466_Pananaru.json'],
            ['nama_pelabuhan' => 'Panjang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0003_Panjang.json'],
            ['nama_pelabuhan' => 'Pantoloan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0429_Pantoloan.json'],
            ['nama_pelabuhan' => 'Pare-pare', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0207_Pare-pare.json'],
            ['nama_pelabuhan' => 'Parit Rampak', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0535_Parit%20Rampak.json'],
            ['nama_pelabuhan' => 'Patimban', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0504_Patimban.json'],
            ['nama_pelabuhan' => 'Pelabuhan ANyer', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0481_Pelabuhan%20ANyer.json'],
            ['nama_pelabuhan' => 'Pelabuhan di DKI Jakartaa', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0483_Pelabuhan%20di%20DKI%20Jakartaa.json'],
            ['nama_pelabuhan' => 'Pelayaran Rakyat Sorong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0455_Pelayaran%20Rakyat%20Sorong.json'],
            ['nama_pelabuhan' => 'Penagi', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0469_Penagi.json'],
            ['nama_pelabuhan' => 'Penajam', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0418_Penajam.json'],
            ['nama_pelabuhan' => 'Pondong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0430_Pondong.json'],
            ['nama_pelabuhan' => 'Poso', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0243_Poso.json'],
            ['nama_pelabuhan' => 'Pototano', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0567_Pototano.json'],
            ['nama_pelabuhan' => 'PP Banjarmasin', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0339_PP%20Banjarmasin.json'],
            ['nama_pelabuhan' => 'PP Karangantu', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0115_PP%20Karangantu.json'],
            ['nama_pelabuhan' => 'PP Labuan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0114_PP%20Labuan.json'],
            ['nama_pelabuhan' => 'PP Mayangan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0497_PP%20Mayangan.json'],
            ['nama_pelabuhan' => 'PP Muara Kintap', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0502_PP%20Muara%20Kintap.json'],
            ['nama_pelabuhan' => 'PP Pasauran', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0488_PP%20Pasauran.json'],
            ['nama_pelabuhan' => 'PP Sumur', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0489_PP%20Sumur.json'],
            ['nama_pelabuhan' => 'PPI Binuangen', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0487_PPI%20Binuangen.json'],
            ['nama_pelabuhan' => 'PPI Nipah Panjang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0540_PPI%20Nipah%20Panjang.json'],
            ['nama_pelabuhan' => 'PPN Ambon', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0361_PPN%20Ambon.json'],
            ['nama_pelabuhan' => 'PPN Donggala', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0427_PPN%20Donggala.json'],
            ['nama_pelabuhan' => 'PPN Kejawanan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0315_PPN%20Kejawanan.json'],
            ['nama_pelabuhan' => 'PPN Kwandang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0246_PPN%20Kwandang.json'],
            ['nama_pelabuhan' => 'PPN Merauke', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0505_PPN%20Merauke.json'],
            ['nama_pelabuhan' => 'PPN Pekalongan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0329_PPN%20Pekalongan.json'],
            ['nama_pelabuhan' => 'PPN Pemangkat', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0309_PPN%20Pemangkat.json'],
            ['nama_pelabuhan' => 'PPN Pengambengan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0350_PPN%20Pengambengan.json'],
            ['nama_pelabuhan' => 'PPN Tanjung Pandan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0313_PPN%20Tanjung%20Pandan.json'],
            ['nama_pelabuhan' => 'PPN Ternate', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0359_PPN%20Ternate.json'],
            ['nama_pelabuhan' => 'PPP Bajomulyo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0331_PPP%20Bajomulyo.json'],
            ['nama_pelabuhan' => 'PPP Carocok', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0495_PPP%20Carocok.json'],
            ['nama_pelabuhan' => 'PPP Klidang Lor', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0496_PPP%20Klidang%20Lor.json'],
            ['nama_pelabuhan' => 'PPP Labuhan Maringgai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0325_PPP%20Labuhan%20Maringgai.json'],
            ['nama_pelabuhan' => 'PPP Lempasing', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0326_PPP%20Lempasing.json'],
            ['nama_pelabuhan' => 'PPP Sungai Rengas', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0310_PPP%20Sungai%20Rengas.json'],
            ['nama_pelabuhan' => 'PPP Tamperan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0346_PPP%20Tamperan.json'],
            ['nama_pelabuhan' => 'PPP Tasik Agung', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0334_PPP%20Tasik%20Agung.json'],
            ['nama_pelabuhan' => 'PPP Tawang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0335_PPP%20Tawang.json'],
            ['nama_pelabuhan' => 'PPP Tegalsari', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0336_PPP%20Tegalsari.json'],
            ['nama_pelabuhan' => 'PPP Teladas', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0328_PPP%20Teladas.json'],
            ['nama_pelabuhan' => 'PPP Teluk Batang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0311_PPP%20Teluk%20Batang.json'],
            ['nama_pelabuhan' => 'PPS Belawan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0301_PPS%20Belawan.json'],
            ['nama_pelabuhan' => 'PPS Bitung', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0356_PPS%20Bitung.json'],
            ['nama_pelabuhan' => 'PPS Cilacap', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0340_PPS%20Cilacap.json'],
            ['nama_pelabuhan' => 'PPS Kendari', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0353_PPS%20Kendari.json'],
            ['nama_pelabuhan' => 'PPS Muara Baru', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0106_PPS%20Muara%20Baru.json'],
            ['nama_pelabuhan' => 'Pulau Laut', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0473_Pulau%20Laut.json'],
            ['nama_pelabuhan' => 'Pulau Makian', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0449_Pulau%20Makian.json'],
            ['nama_pelabuhan' => 'Pulau Moti', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0446_Pulau%20Moti.json'],
            ['nama_pelabuhan' => 'Pulau Palue', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0556_Pulau%20Palue.json'],
            ['nama_pelabuhan' => 'Pulau Tiga', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0475_Pulau%20Tiga.json'],
            ['nama_pelabuhan' => 'Pure', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0575_Pure.json'],
            ['nama_pelabuhan' => 'Raha', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0229_Raha.json'],
            ['nama_pelabuhan' => 'Raijua', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0542_Raijua.json'],
            ['nama_pelabuhan' => 'Rasau Jaya', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0479_Rasau%20Jaya.json'],
            ['nama_pelabuhan' => 'Reo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0557_Reo.json'],
            ['nama_pelabuhan' => 'Roro Kuala Tungkal', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0538_Roro%20Kuala%20Tungkal.json'],
            ['nama_pelabuhan' => 'Rote', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0186_Rote.json'],
            ['nama_pelabuhan' => 'Rum', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0434_Rum.json'],
            ['nama_pelabuhan' => 'Samarinda', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0194_Samarinda.json'],
            ['nama_pelabuhan' => 'Sampit', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0470_Sampit.json'],
            ['nama_pelabuhan' => 'Samudera', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0012_Samudera.json'],
            ['nama_pelabuhan' => 'Sanana', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0585_Sanana.json'],
            ['nama_pelabuhan' => 'Sangkapura', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0391_Sangkapura.json'],
            ['nama_pelabuhan' => 'Sangkuliran', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0199_Sangkuliran.json'],
            ['nama_pelabuhan' => 'Sausapor', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0457_Sausapor.json'],
            ['nama_pelabuhan' => 'Seba', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0185_Seba.json'],
            ['nama_pelabuhan' => 'Sedanau', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0474_Sedanau.json'],
            ['nama_pelabuhan' => 'Sekupang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0084_Sekupang.json'],
            ['nama_pelabuhan' => 'Semayang, Balikpapan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0193_Semayang,%20Balikpapan.json'],
            ['nama_pelabuhan' => 'Sentolo Kawat', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0592_Sentolo%20Kawat.json'],
            ['nama_pelabuhan' => 'Serasan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0478_Serasan.json'],
            ['nama_pelabuhan' => 'Serui', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0280_Serui.json'],
            ['nama_pelabuhan' => 'Sibolga', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0026_Sibolga.json'],
            ['nama_pelabuhan' => 'Sidangole', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0433_Sidangole.json'],
            ['nama_pelabuhan' => 'Sikeli', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0407_Sikeli.json'],
            ['nama_pelabuhan' => 'Sinabang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0023_Sinabang.json'],
            ['nama_pelabuhan' => 'Sintete', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0088_Sintete.json'],
            ['nama_pelabuhan' => 'Siompu', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0580_Siompu.json'],
            ['nama_pelabuhan' => 'Soekarno - Hatta', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0010_Soekarno%20-%20Hatta.json'],
            ['nama_pelabuhan' => 'Sofifi', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0435_Sofifi.json'],
            ['nama_pelabuhan' => 'Solor', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0558_Solor.json'],
            ['nama_pelabuhan' => 'Sorong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0291_Sorong.json'],
            ['nama_pelabuhan' => 'Subaim', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0443_Subaim.json'],
            ['nama_pelabuhan' => 'Subi', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0477_Subi.json'],
            ['nama_pelabuhan' => 'Sukabangun', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0089_Sukabangun.json'],
            ['nama_pelabuhan' => 'Sunda Kelapa', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0101_Sunda%20Kelapa.json'],
            ['nama_pelabuhan' => 'Susoh Blang Pidie', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0494_Susoh%20Blang%20Pidie.json'],
            ['nama_pelabuhan' => 'Tahuna', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0251_Tahuna.json'],
            ['nama_pelabuhan' => 'Talang Duku', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0537_Talang%20Duku.json'],
            ['nama_pelabuhan' => 'Taman Nasional Pulau Komodo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0541_Taman%20Nasional%20Pulau%20Komodo.json'],
            ['nama_pelabuhan' => 'Tampo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0413_Tampo.json'],
            ['nama_pelabuhan' => 'Tanjung Api Api', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0380_Tanjung%20Api%20Api.json'],
            ['nama_pelabuhan' => 'Tanjung Balai Asahan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0047_Tanjung%20Balai%20Asahan.json'],
            ['nama_pelabuhan' => 'Tanjung Batu', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0383_Tanjung%20Batu.json'],
            ['nama_pelabuhan' => 'Tanjung Bira', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0404_Tanjung%20Bira.json'],
            ['nama_pelabuhan' => 'Tanjung Intan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0005_Tanjung%20Intan.json'],
            ['nama_pelabuhan' => 'Tanjung Kelian', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0382_Tanjung%20Kelian.json'],
            ['nama_pelabuhan' => 'Tanjung Mas', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0006_Tanjung%20Mas.json'],
            ['nama_pelabuhan' => 'Tanjung Pandan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0099_Tanjung%20Pandan.json'],
            ['nama_pelabuhan' => 'Tanjung Perak', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0007_Tanjung%20Perak.json'],
            ['nama_pelabuhan' => 'Tanjung Pising', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0574_Tanjung%20Pising.json'],
            ['nama_pelabuhan' => 'Tanjung Priok', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0004_Tanjung%20Priok.json'],
            ['nama_pelabuhan' => 'Tanjung Santan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0198_Tanjung%20Santan.json'],
            ['nama_pelabuhan' => 'Tanjung Silopo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0498_Tanjung%20Silopo.json'],
            ['nama_pelabuhan' => 'Tarakan', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0195_Tarakan.json'],
            ['nama_pelabuhan' => 'Tarempa', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0085_Tarempa.json'],
            ['nama_pelabuhan' => 'Tebas Kuala', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0389_Tebas%20Kuala.json'],
            ['nama_pelabuhan' => 'Teluk Bayur', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0002_Teluk%20Bayur.json'],
            ['nama_pelabuhan' => 'Teluk Bungus', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0377_Teluk%20Bungus.json'],
            ['nama_pelabuhan' => 'Teluk Dalam', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0028_Teluk%20Dalam.json'],
            ['nama_pelabuhan' => 'Tenau', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0008_Tenau.json'],
            ['nama_pelabuhan' => 'Tobelo', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0437_Tobelo.json'],
            ['nama_pelabuhan' => 'Tolandano', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0578_Tolandano.json'],
            ['nama_pelabuhan' => 'Tondasi, Muna Barat', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0406_Tondasi,%20Muna%20Barat.json'],
            ['nama_pelabuhan' => 'Torobulu', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0412_Torobulu.json'],
            ['nama_pelabuhan' => 'TPI Ie Meulle', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0490_TPI%20Ie%20Meulle.json'],
            ['nama_pelabuhan' => 'TPI Panimbang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0486_TPI%20Panimbang.json'],
            ['nama_pelabuhan' => 'Tua Pejat', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0379_Tua%20Pejat.json'],
            ['nama_pelabuhan' => 'Tual', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0271_Tual.json'],
            ['nama_pelabuhan' => 'Tulehu', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0270_Tulehu.json'],
            ['nama_pelabuhan' => 'Ulu Siau', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0562_Ulu%20Siau.json'],
            ['nama_pelabuhan' => 'Wa Ode Buri', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0444_Wa%20Ode%20Buri.json'],
            ['nama_pelabuhan' => 'Waara', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0577_Waara.json'],
            ['nama_pelabuhan' => 'Waesai', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0451_Waesai.json'],
            ['nama_pelabuhan' => 'Waingapu', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0189_Waingapu.json'],
            ['nama_pelabuhan' => 'Waipirit', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0276_Waipirit.json'],
            ['nama_pelabuhan' => 'Waiwerang', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0402_Waiwerang.json'],
            ['nama_pelabuhan' => 'Wanci', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0423_Wanci.json'],
            ['nama_pelabuhan' => 'Wasior', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0285_Wasior.json'],
            ['nama_pelabuhan' => 'Weda', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0584_Weda.json'],
            ['nama_pelabuhan' => 'Wonokerto', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0589_Wonokerto.json'],
            ['nama_pelabuhan' => 'Wowong', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0553_Wowong.json'],
            ['nama_pelabuhan' => 'Yos Sudarso', 'link_api' => 'https://peta-maritim.bmkg.go.id/public_api/pelabuhan/0015_Yos%20Sudarso.json'],
        ];
        $this->db->table('pelabuhan')->insertBatch($dataPelabuhan);
    }
}
