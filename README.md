# Fleetify Absensi System

## Overview
Fleetify Absensi System adalah aplikasi untuk mencatat kedisiplinan karyawan secara manual. Sistem ini memungkinkan pencatatan absensi masuk dan keluar karyawan, pengelompokan berdasarkan departemen, serta menampilkan laporan ketepatan absensi.  

**Link Aplikasi:** [http://fleetify.frecode.my.id](http://fleetify.frecode.my.id)

**Tujuan Sistem:**  
- Mempermudah monitoring absensi karyawan  
- Memudahkan evaluasi kedisiplinan berdasarkan waktu masuk & keluar  

---

## Fitur Utama
1. CRUD Karyawan  
2. CRUD Departemen  
3. POST Absen Masuk  
4. PUT Absen Keluar  
5. GET List Log Absensi Karyawan (dengan filter tanggal & departemen, dan cek ketepatan waktu)  

---

## Teknologi & Arsitektur
- **Backend:** PHP / Laravel (sesuaikan jika pakai Golang)  
- **Frontend:** PHP / JS (Laravel / NextJS)  
- **Database:** MySQL  
- **Hosting:** [http://fleetify.frecode.my.id](http://fleetify.frecode.my.id)  

---

## ERD & Flowchart
(Sertakan screenshot atau link diagram yang sudah dibuat)  

**Tabel Utama:**  
- **Karyawan:** Menyimpan data karyawan  
- **Departemen:** Menyimpan data departemen/divisi  
- **Absensi:** Menyimpan catatan masuk & keluar karyawan  

---


## Cara Menggunakan / User Guide

### Admin:
1. Login ke sistem (jika ada fitur login)  
2. Tambah / edit / hapus karyawan  
3. Tambah / edit / hapus departemen  
4. Lihat laporan absensi dengan filter tanggal & departemen  

### Karyawan:
1. Pilih **Riwayat Absens**  
2. Pilih **Absen Keluar & Masuk**  
3. Lihat laporan absensi (opsional)  

## Catatan Khusus
- Sistem absensi bersifat manual karena **tidak ada ketentuan khusus** mengenai jam masuk/keluar atau shift karyawan.  
- Laporan absensi dapat difilter berdasarkan tanggal dan departemen.  
- Sistem dapat dikembangkan lebih lanjut dengan fitur login, notifikasi, atau integrasi ke perangkat absensi.

---

## Setup / Instalasi

1. Clone repository:  
```bash
git clone https://github.com/fremasadi/fleetify-tes
