# 📰 UmparanWP — Tema WordPress Portal Berita ala Kumparan

**UmparanWP (Umparan) adalah tema WordPress yang dirancang khusus untuk portal berita dan media online, terinspirasi dari tampilan dan fungsionalitas [kumparan.com](https://kumparan.com). Dengan kombinasi desain modern, performa tinggi, dan fitur-fitur *news-centric*, tema ini menjadi fondasi ideal bagi penerbit digital.**

---

<p align="center">
  <a href="https://github.com/mokesano/umparanwp">
    <img src="https://img.shields.io/badge/WordPress-5.0%2B-21759B?style=for-the-badge&logo=wordpress&logoColor=white" alt="WordPress Version">
  </a>
  <a href="https://github.com/mokesano/kumparanwp/blob/main/license.txt">
    <img src="https://img.shields.io/badge/license-GPL%202.0-blue?style=for-the-badge" alt="License">
  </a>
  <a href="https://github.com/mokesano/kumparanwp/actions">
    <img src="https://img.shields.io/badge/build-passing-brightgreen?style=for-the-badge&logo=github-actions&logoColor=white" alt="Build Status">
  </a>
  <a href="https://github.com/mokesano/kumparanwp/releases">
    <img src="https://img.shields.io/badge/release-v1.0.0-lightgrey?style=for-the-badge" alt="Release">
  </a>
  <a href="https://github.com/mokesano/kumparanwp/security/advisories">
    <img src="https://img.shields.io/badge/security-policy-important?style=for-the-badge&logo=github" alt="Security Policy">
  </a>
</p>

<br>

<p align="center">
  <em>📡 Trending · ⏱️ Terkini · 🔥 Popular · 📖 Read Time · ❤️ Like System</em>
</p>

---

## 📖 Tentang Tema

UmparanWP (nama teknis: **Umparan**) adalah tema WordPress *news‑first* yang mereplikasi estetika dan alur baca portal berita modern. Dikembangkan oleh **Wizdam** dan dipelihara oleh [Rochmady](https://github.com/mokesano), tema ini mengedepankan **kecepatan**, **kemudahan kustomisasi**, dan **fitur‑fitur yang familiar bagi pembaca berita Indonesia**.

> **Demo Tema**: [https://wizdam.sangia.org/demo/umparan/](https://wizdam.sangia.org/demo/umparan/)

---

## ✨ Fitur Utama

| 🔧 Fitur | 📝 Deskripsi |
| :--- | :--- |
| 🎨 **Desain Mirip Kumparan** | Tata letak dan estetika yang terinspirasi langsung dari kumparan.com |
| 📱 **Fully Responsive** | Tampilan optimal di desktop, tablet, dan smartphone |
| 🔥 **Trending Widget** | Shortcode `[trending]` untuk menampilkan artikel terpopuler berdasarkan *views* |
| ⏱️ **Terkini Widget** | Shortcode `[terkini]` untuk menampilkan berita terbaru |
| 📖 **Read Time** | Estimasi waktu baca otomatis pada setiap artikel |
| ❤️ **Like System** | Tombol *like* untuk interaksi pembaca |
| 🕰️ **Time Ago** | Format waktu relatif ala Kumparan (mis. "3 jam yang lalu") |
| 💬 **Comment Threads** | Tampilan komentar bersarang dengan avatar |
| 🖼️ **Lightbox** | Pembesar gambar *in‑page* untuk foto dan galeri |
| 🧭 **Menu Image** | Dukungan ikon/gambar pada item navigasi |
| 🎛️ **Customizer Ready** | Panel kustomisasi langsung dari dashboard WordPress |
| 📝 **Post Formats** | Dukungan penuh untuk format: standard, image, video, quote, link, gallery, audio, chat |
| 🏷️ **Custom Post Types** | Dukungan *custom post type* untuk konten khusus |
| 🔍 **SEO Friendly** | Kompatibel dengan plugin SEO populer |
| ⚡ **HTML5 Markup** | Markup semantik modern untuk *search-form*, *comment-form*, *gallery*, dll |
| 🌐 **Translation Ready** | *Text domain* `wizdamapp` siap diterjemahkan |

---

## 🚀 Instalasi

### Persyaratan Sistem

| Perangkat Lunak | Versi Minimum |
| :--- | :--- |
| WordPress | **6.0** atau lebih tinggi |
| PHP | **7.4** atau lebih tinggi |
| MySQL | **5.0** atau lebih tinggi |

### Langkah Instalasi

1. Unduh tema sebagai file `.zip` dari [halaman rilis](https://github.com/mokesano/umparanwp/releases) atau dengan mengkloning repositori ini.
2. Masuk ke dashboard WordPress Anda.
3. Buka menu **Appearance** > **Themes**.
4. Klik tombol **Add New**, lalu pilih **Upload Theme**.
5. Pilih file `umparanwp.zip` yang telah Anda unduh dan klik **Install Now**.
6. Setelah instalasi selesai, klik **Activate**.

### Instalasi Manual (FTP)

```bash
# Clone repositori
git clone https://github.com/mokesano/umparanwp.git

# Upload folder ke wp-content/themes/
# Lalu aktifkan melalui Appearance > Themes
```

---

## 🧩 Shortcode Bawaan

Tema ini dilengkapi *shortcode* siap pakai untuk menampilkan konten dinamis:

### 🔥 Trending

Menampilkan artikel terpopuler dalam rentang waktu tertentu.

```
[trending category="teknologi" days="7" count="5"]
```

### ⏱️ Terkini

Menampilkan artikel terbaru dari kategori tertentu.

```
[terkini category="nasional" count="10"]
```

> Anda dapat menempatkan shortcode ini di *post*, *page*, atau *widget* teks.

---

## 🎛️ Penyesuaian

Anda dapat menyesuaikan tema melalui:

* **Customizer WordPress**: Buka **Appearance** > **Customize** untuk mengubah logo, warna, header, dan widget.
* **File CSS**: Edit file di dalam folder `assets/css/` untuk penyesuaian tampilan lebih lanjut.
* **Widget Areas**: Tambahkan widget di area *sidebar* melalui **Appearance** > **Widgets**.
* **Menu Image**: Tambahkan ikon pada menu navigasi melalui **Appearance** > **Menus**.

---

## 🖥️ Demo

Lihat tema beraksi di: [https://wizdam.sangia.org/demo/umparan/](https://wizdam.sangia.org/demo/umparan/)

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Jika Anda ingin melaporkan bug, mengusulkan fitur baru, atau mengirimkan *pull request*, silakan ikuti panduan berikut:

1. Fork repositori ini.
2. Buat branch baru (`git checkout -b fitur-baru`).
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur baru'`).
4. Push ke branch (`git push origin fitur-baru`).
5. Buat Pull Request.

Proyek ini mengadopsi [Contributor Covenant Code of Conduct](https://github.com/mokesano/umparanwp/blob/main/CODE_OF_CONDUCT.md). Dengan berpartisipasi, Anda diharapkan menegakkan kode etik ini.

---

## 🔒 Keamanan

Keamanan adalah prioritas. **Jangan umbar kerentanan secara publik.**

* **Pelaporan**: Kirim laporan kerentanan ke [security@sangia.org](mailto:security@sangia.org)
* **Respons**: Pengelola utama akan merespons dalam **48 jam**
* **Advisori**: Dipublikasikan di [GitHub Security Advisories](https://github.com/mokesano/umparanwp/security/advisories)

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **GNU General Public License v3.0 (atau versi lebih baru)**. Lihat [license.txt](https://github.com/mokesano/kumparanwp/blob/main/license.txt) untuk teks lengkap.

| Izin | Ketentuan |
| :--- | :--- |
| ✅ Bebas digunakan (komersial & non‑komersial) | ⚠️ Derivative work harus menggunakan lisensi yang sama (*copyleft*) |
| ✅ Bebas dimodifikasi & didistribusikan | ⚠️ Harus menyertakan kode sumber jika didistribusikan |

---

## 🙏 Kredit & Pengakuan

| 🏷️ Atribusi | 🔗 Referensi |
| :--- | :--- |
| **Pengembang Tema** | [WizdamApp](https://wizdam.sangia.org/) |
| **Maintainer** [Wizdam Archon (archoun)](https://github.com/archoun) | [Rochmady (mokesano)](https://github.com/mokesano) |
| **Terinspirasi oleh** | [Kumparan.com](https://kumparan.com) |
| **Lisensi** | [GPL v3.0](http://www.gnu.org/licenses/gpl-3.0.html) |

---

<p align="center">
  <br>
  <sub>Dibangun dengan ❤️ untuk ekosistem media digital Indonesia</sub>
  <br><br>
  <a href="https://github.com/mokesano/umparanwp/stargazers">
    <img src="https://img.shields.io/github/stars/mokesano/umparanwp?style=social" alt="GitHub Stars">
  </a>
  <a href="https://github.com/mokesano/umparanwp/network/members">
    <img src="https://img.shields.io/github/forks/mokesano/umparanwp?style=social" alt="GitHub Forks">
  </a>
  <br><br>
  <sub>© 2025–2026 Wizdam Archon & Rochmady. Dilisensikan di bawah GPL‑2.0.</sub>
</p>