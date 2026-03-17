# Panduan Manajemen Menu, Role & Permission

Pada boilerplate ini, menu sidebar bersifat dinamis dan diambil dari database. Seiring dengan pembaruan sistem terbaru, akses pembatasan sebuah **Menu** kini tidak lagi menggunakan ketik manual *Permission*, melainkan langsung dipilih berdasarkan **Role** melalui Checkboxes.

Menu akan secara otomatis **disembunyikan/ditampilkan** berdasarkan Role yang dihubungkan ke menu tersebut serta Role dari akun yang sedang login.

---

## Alur Kerja Utama

### 1. Membuat Role Baru (Jika Belum Ada)
Jika Anda memiliki grup pengguna baru, Anda bisa membuat Role-nya terlebih dahulu.
1. Login sebagai `admin`.
2. Buka menu **User Management -> Roles**.
3. Klik **Tambah Role** (misalnya `Finance`).
4. Berikan akses _Permissions_ spesifik untuk tindakan CRUD di halaman lain, lalu Simpan.

### 2. Tambahkan atau Edit Menu
Setelah Role tersedia, Anda bisa menghubungkannya ke sebuah Menu.

1. Buka menu **Settings -> Menu Management**.
2. Klik tombol **Tambah Menu** atau edit menu yang sudah ada (misal: "Laporan Keuangan").
3. Di dalam form, isi informasi dasar menu:
   - **Nama Menu, Icon, Group Name, dsb.**
4. Pada bagian bawah form Anda akan melihat bagian **Hak Akses Role**.
   - Ini adalah kumpulan Checkbox yang menampilkan semua Role yang tersedia di sistem Anda.
   - **Centang Role `Finance`**. (Anda dapat mencentang lebih dari satu, misal: `Finance` dan `Direktur`).
5. Klik **Simpan/Update**.

*(Dengan ini, hanya user yang tergabung ke salah satu Role yang tercentang tadi yang berhak melihat menu di sidebarnya. User di luar role tersebut tidak akan pernah tahu menu itu ada).*

### 3. Assign Role kepada User
Agar karyawan bersangkutan dapat mengakses, masukkan Employee tersebut ke Role.

1. Buka menu **User Management -> Users**.
2. Cari nama karyawan terkait, lalu Edit.
3. Di tab Edit, assign/centang Role `Finance`.
4. Simpan. Selesai! Saat karyawan itu login, menu "Laporan Keuangan" akan otomatis muncul di sidebarnya.

---

## FAQ (Pertanyaan Umum)

**1. Bagaimana jika saya tidak mencentang Role satupun di form Menu?**
Jika tidak ada (_kosong_) Role yang dicentang pada field "Hak Akses Role", maka menu tersebut akan tampil untuk **semua User secara Publik** (asal mereka dalam keadaan login), terlepas dari apapun Role mereka (seperti menu Dashboard default).

**2. Apakah Superadmin kebal filter?**
Ya. Segala *logic* pengecekan Role di `MenuHelper.php` akan selalu di-*bypass* untuk user yang memegang role `superadmin`. Menu se-rahasia apapun pasti akan tetap ter-render untuk superadmin.

**3. Tapi bukankah Spatie tetap punya Permissions? Kapan saya pakainya?**
Sistem *Permissions* Spatie tetap berjalan. Biasanya, *Permissions* (contoh: `manage-users`, `delete-users`) direkatkan ke *Role* dan lebih difokuskan untuk pembatasan tindakan **di level Controller atau di dalam isi Halaman** (contoh: menyembunyikan Tombol Hapus).
Sedangkan untuk visibilitas memunculkan/menyembunyikan link di Sidebar Menu, kita sekarang menggunakan fitur *Checkbox Hak Akses Role* langsung pada Menu.
