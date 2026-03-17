# Panduan Manajemen Menu, Role & Permission

Pada boilerplate ini, menu sidebar bersifat dinamis dan diambil dari database. Menu akan secara otomatis **disembunyikan/ditampilkan** berdasarkan hak akses (Permission) yang dimiliki oleh akun (User) yang sedang login.

Berikut adalah alur kerja utama saat Anda ingin membuat menu baru dan membatasinya untuk Role tertentu (contoh: Role `Keuangan`).

---

## Skenario Kasus: Membuat Menu "Laporan Keuangan"

Kita ingin membuat menu **Laporan Keuangan**. Menu ini hanya boleh dilihat dan diakses oleh karyawan di departemen keuangan yang memiliki Role **Finance**.

### 1. Buat Permission Baru
Langkah pertama adalah mendefinisikan "kunci" atau permission untuk menu tersebut.

1. Buka browser dan login sebagai `admin` (Role: Superadmin).
2. Di sidebar kiri, buka menu **User Management -> Roles**.
3. *Opsional:* Jika Anda belum punya Permission spesifik, Anda harus membuatnya. Di sistem boilerplate ini, permission bisa ditambahkan via Seeder atau langsung via Database Tools. 
   *(Catatan: Anda bisa mengembangkan controller Permissions Management sendiri nantinya jika dibutuhkan, namun untuk best practice, daftarkan permission baru di menu Roles -> Tambah Role saat Anda ingin mengubah.*
   **Contoh Nama Permission:** `akses-laporan-keuangan`.

### 2. Tambahkan Menu melalui Interface
Setelah kita tahu nama permission-nya (`akses-laporan-keuangan`), kita hubungkan dengan Menu.

1. Masih sebagai `admin`, akses halaman **Menu Management** di sidebar.
2. Klik tombol **Tambah Menu** biru di kanan atas.
3. Isi informasi menu:
   - **Nama Menu:** `Laporan Keuangan`
   - **Icon:** `dashboard` *(Gunakan nama icon dari `MenuHelper`, atau tinggalkan kosong untuk icon default)*.
   - **Route Name:** `laporan.keuangan.index` *(Pastikan route ini ada di `routes/web.php`)*
   - **Group Name:** `Keuangan` *(Untuk mengelompokkan sidebar)*
   - **Order:** `1` *(Urutan menu)*
   - **Permission:** **`akses-laporan-keuangan`** (Sangat Penting! Pastikan ketikkan nama permission yang Anda buat di Langkah 1 persis di sini).
   - Pastikan checkbox **Aktif** dicentang.
4. Klik **Simpan**.

*(Sekarang, karena menu ini memiliki Permission, jika ada User biasa yang login dan tidak punya permission `akses-laporan-keuangan`, ia **TIDAK AKAN** melihat menu ini di sidebar).*

### 3. Buat/Edit Role untuk Memberikan Permission
Kunci (Menu Permission) sudah terpasang di pintu (Menu Laporan). Sekarang kita berikan "Kunci" tersebut ke Role.

1. Buka menu **User Management -> Roles**.
2. Klik **Tambah Role** (Buat role baru dengan nama `Finance`) ATAU edit Role yang sudah ada.
3. Pada halaman *Edit Role*, akan muncul kotak-kotak checkbox untuk **Permissions**.
4. **Centang** permission `akses-laporan-keuangan`.
5. Klik **Simpan**.

### 4. Assign Role kepada User (Karyawan)
Terakhir, berikan peran tersebut ke user spesifik.

1. Buka menu **User Management -> Users**.
2. Pilih Karyawan departemen keuangan (atau buat User baru), klik **Edit**.
3. Di bagian bawah (*Role*), akan muncul opsi Role `Finance`.
4. **Centang** Role `Finance`.
5. Klik **Update**.

### Selesai! 🎉
**Hasil Uji Coba:**
- Jika Karyawan A (Role: Finance) login, ia akan **melihat** Sidebar Group "Keuangan" -> Menu "Laporan Keuangan".
- Jika Karyawan B (Role: Staff Biasa) login, Menu Laporan Keuangan akan **hilang** dari layar dashboardnya.

---

## FAQ (Pertanyaan Umum)

**1. Bagaimana jika saya tidak mengisi field Permission di form Menu?**
Jika field "Permission" saat membuat menu dikosongkan, maka menu tersebut akan tampil untuk **semua User yang bisa login**, terlepas dari apapun Role mereka (mirip menu Dashboard saat ini).

**2. Apakah Superadmin bisa melihat semua menu?**
Ya. Pada `DatabaseSeeder`, Role `superadmin` diciptakan dengan perintah `$superadmin->givePermissionTo(Permission::all());`. Semua menu dengan permission apapun akan bisa diakses superadmin.

**3. Bagaimana cara mengganti Icon menu?**
Buka file `app/Helpers/MenuHelper.php`. Di dalamnya terdapat fungsi `getIconSvg()`. Anda bisa mengambil kode `<svg>` icon baru (contohnya dari website Heroicons atau Tabler Icons) lalu menambahkannya ke array list, berikan nama kunci (seperti `laporan-icon`), lalu pakai kunci tersebut di form Menu Management.
