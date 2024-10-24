<div class="mb-3">
    <label for="keahlian" class="form-label">Keahlian</label>

    <!-- Container untuk dropdown keahlian -->
    <div id="keahlian-container">
        @foreach($selectedKeahlian as $key => $keahlianID)
            <div class="keahlian-group">
                <select name="keahlian[]" class="form-select keahlian-dropdown">
                    <option selected disabled>Pilih Keahlian</option>
                    @foreach($keahlian as $namaKeahlian)
                        <option value="{{ $namaKeahlian->keahlianID }}"
                            {{ in_array($namaKeahlian->keahlianID, $selectedKeahlian) && $namaKeahlian->keahlianID != $keahlianID ? 'hidden' : '' }}
                            {{ $namaKeahlian->keahlianID == $keahlianID ? 'selected' : '' }}>
                            {{ $namaKeahlian->namaKeahlian }}
                        </option>
                    @endforeach
                </select>
                @if($key == 0)
                    <!-- Tombol + hanya ditampilkan pada dropdown pertama -->
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-circle" id="add-keahlian-btn">+</button>
                @else
                    <!-- Tombol - ditampilkan pada dropdown selain yang pertama -->
                    <button type="button" class="btn btn-outline-danger btn-sm rounded-circle remove-keahlian-btn">-</button>
                @endif
            </div>
        @endforeach

        <!-- Jika tidak ada keahlian yang sudah dipilih, tampilkan satu dropdown kosong -->
        @if(empty($selectedKeahlian))
            <div class="keahlian-group">
                <select name="keahlian[]" class="form-select keahlian-dropdown">
                    <option selected disabled>Pilih Keahlian</option>
                    @foreach($keahlian as $namaKeahlian)
                        <option value="{{ $namaKeahlian->keahlianID }}">{{ $namaKeahlian->namaKeahlian }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-circle" id="add-keahlian-btn">+</button>
            </div>
        @endif
    </div>
</div>

<script>
    let keahlianCount = {{ count($selectedKeahlian) }};  // Jumlah dropdown keahlian awal
    let totalKeahlian = @json($keahlian->count()); // Jumlah total keahlian di database

    // Mengambil semua keahlian yang dipilih
    function getSelectedKeahlian() {
        let selectedKeahlian = [];
        document.querySelectorAll('.keahlian-dropdown').forEach(select => {
            if (select.value) {
                selectedKeahlian.push(select.value);
            }
        });
        return selectedKeahlian;
    }

    // Memperbarui tampilan dropdown berdasarkan keahlian yang sudah dipilih
    function updateDropdownOptions() {
        let selectedKeahlian = getSelectedKeahlian(); // Ambil keahlian yang sudah dipilih

        document.querySelectorAll('.keahlian-dropdown').forEach(select => {
            let options = select.querySelectorAll('option');
            options.forEach(option => {
                // Sembunyikan opsi yang sudah dipilih
                if (selectedKeahlian.includes(option.value) && select.value !== option.value) {
                    option.style.display = 'none';
                } else {
                    option.style.display = 'block';  // Tampilkan opsi yang belum dipilih
                }
            });
        });
    }

    // Event listener untuk tombol + (Tambah dropdown)
    document.getElementById('keahlian-container').addEventListener('click', function(e) {
        if (e.target.id === 'add-keahlian-btn') {
            keahlianCount = document.querySelectorAll('.keahlian-group').length;

            if (keahlianCount < totalKeahlian) {
                let newDropdown = document.createElement('div');
                newDropdown.classList.add('keahlian-group');
                newDropdown.innerHTML = `
                    <select name="keahlian[]" class="form-select keahlian-dropdown">
                        <option selected disabled>Pilih Keahlian</option>
                        @foreach($keahlian as $namaKeahlian)
                            <option value="{{ $namaKeahlian->keahlianID }}">{{ $namaKeahlian->namaKeahlian }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-outline-danger btn-sm rounded-circle remove-keahlian-btn">-</button>
                `;

                document.getElementById('keahlian-container').appendChild(newDropdown);
                keahlianCount++;  // Perbarui keahlianCount

                // Sembunyikan tombol + jika sudah mencapai jumlah total keahlian
                if (keahlianCount === totalKeahlian) {
                    e.target.style.display = 'none';
                }

                updateDropdownOptions(); // Perbarui opsi dropdown
                toggleRemoveButtons(); // Perbarui tampilan tombol hapus
            } else {
                alert("Semua keahlian sudah dipilih.");
            }
        }
    });

    // Fungsi untuk menampilkan atau menyembunyikan tombol hapus (-)
    function toggleRemoveButtons() {
        let removeButtons = document.querySelectorAll('.remove-keahlian-btn');
        if (keahlianCount > 1) {
            removeButtons.forEach(button => button.style.display = 'inline-block');
        } else {
            removeButtons.forEach(button => button.style.display = 'none');
        }
    }

    // Event listener untuk menghapus dropdown keahlian
    document.getElementById('keahlian-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-keahlian-btn')) {
            let keahlianGroup = e.target.closest('.keahlian-group');
            let keahlianValue = keahlianGroup.querySelector('.keahlian-dropdown').value; // Ambil nilai yang dipilih

            keahlianGroup.remove();
            keahlianCount = document.querySelectorAll('.keahlian-group').length;

            // Tampilkan tombol + jika jumlah dropdown kurang dari total keahlian
            if (keahlianCount < totalKeahlian) {
                document.getElementById('add-keahlian-btn').style.display = 'inline-block';
            }

            updateDropdownOptions(); // Perbarui opsi dropdown

            // Pastikan opsi yang dihapus ditampilkan kembali di dropdown lain
            document.querySelectorAll('.keahlian-dropdown').forEach(select => {
                let option = select.querySelector(`option[value="${keahlianValue}"]`);
                if (option) {
                    option.style.display = 'block';
                }
            });

            toggleRemoveButtons(); // Perbarui tampilan tombol hapus
        }
    });

    // Event listener untuk memperbarui opsi ketika dropdown keahlian berubah
    document.getElementById('keahlian-container').addEventListener('change', function(e) {
        if (e.target.classList.contains('keahlian-dropdown')) {
            updateDropdownOptions(); // Perbarui opsi ketika ada perubahan
        }
    });

    // Pastikan untuk menyembunyikan tombol + jika keahlian penuh sejak load awal
    document.addEventListener('DOMContentLoaded', function() {
        keahlianCount = document.querySelectorAll('.keahlian-group').length;
        if (keahlianCount >= totalKeahlian) {
            document.getElementById('add-keahlian-btn').style.display = 'none';
        }

        // Memperbarui opsi untuk dropdown yang sudah ada saat awal
        updateDropdownOptions();
    });

    toggleRemoveButtons(); // Jalankan fungsi untuk menyembunyikan tombol hapus jika hanya ada satu dropdown
</script>
