1. Alur Masuk Data (Data Ingestion)
Sistem ini bekerja berdasarkan relasi data dari halaman depan (front-end shop).

Ketika seorang pembeli memilih produk di halaman Shop (misalnya produk Match Companion : Unification Series), mengisi formulir data diri, dan melakukan order, data tersebut akan dikirim oleh database ke halaman admin ini secara otomatis.

2. Struktur Penyimpanan & Tampilan Tabel
Sistem menyusun data pesanan yang masuk ke dalam format tabel dinamis (Orders Table) yang memuat informasi krusial untuk tim operasional/penjual:

No & Date: Menunjukkan urutan antrean dan tanggal pasti kapan konsumen melakukan pemesanan (berurutan dari tahun 2025 hingga 2026).

Customer Identity: Sistem memisahkan kolom Name, Address (Alamat pengiriman lengkap), dan Number Phone (Nomor HP/WhatsApp pembeli). dan bukti pembayaran dalam bentuk foto.

Product: Mengidentifikasi item spesifik yang dibeli pelanggan agar admin tidak salah menyiapkan barang.

Singkatnya, halaman ini bertindak sebagai pusat kendali pemrosesan orderan, di mana admin melihat siapa yang membeli, apa yang dibeli, ke mana barang harus dikirim, dan memiliki otoritas untuk menghapus data jika pesanan sudah selesai diproses atau dibatalkan.