<div class="mb-3">
    <!-- Label hanya satu kali -->
    <label for="keahlian" class="form-label">Keahlian</label>
    
    <!-- Container untuk dropdown keahlian -->
    <div id="keahlian-container">
        <div class="keahlian-group">
            <select name="keahlian[]" class="form-select keahlian-dropdown">
                <option selected disabled>Pilih Keahlian</option>
                @foreach($keahlian as $namaKeahlian)
                    <option value="{{ $namaKeahlian->keahlianID }}">{{ $namaKeahlian->namaKeahlian }}</option>
                @endforeach
            </select>
            <!-- Tombol + untuk menambah dropdown keahlian -->
            <button type="button" class="btn btn-outline-primary btn-sm rounded-circle" id="add-keahlian-btn">+</button>
        </div>
    </div>
</div>

<script>
    let keahlianCount = 1;  // isi dropdown awal 1
    let totalKeahlian = @json($keahlian->count()); // jumlah data keahlian pada database

    function getSelectedKeahlian() {
        let selectedKeahlian = [];
        document.querySelectorAll('.keahlian-dropdown').forEach(select => {
            if (select.value) {
                selectedKeahlian.push(select.value);
            }
        });
        return selectedKeahlian;
    }

    function updateDropdownOptions() {
        let selectedKeahlian = getSelectedKeahlian();

        document.querySelectorAll('.keahlian-dropdown').forEach(select => {
            let options = select.querySelectorAll('option');
            options.forEach(option => {
                if (selectedKeahlian.includes(option.value) && select.value !== option.value) {
                    option.style.display = 'none';  // Hide already selected options
                } else {
                    option.style.display = 'block';  // Show available options
                }
            });
        });
    }

    document.getElementById('add-keahlian-btn').addEventListener('click', function() {
        keahlianCount++;

        if (keahlianCount === totalKeahlian) {
            this.style.display = 'none';
        }

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
        updateDropdownOptions();
        toggleRemoveButtons();
    });

    function toggleRemoveButtons() {
        let removeButtons = document.querySelectorAll('.remove-keahlian-btn');
        if (keahlianCount > 1) {
            removeButtons.forEach(button => button.style.display = 'inline-block');
        } else {
            removeButtons.forEach(button => button.style.display = 'none');
        }
    }

    document.getElementById('keahlian-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-keahlian-btn')) {
            let keahlianGroup = e.target.closest('.keahlian-group');
            keahlianGroup.remove();
            keahlianCount--;

            if (keahlianCount < totalKeahlian) {
                document.getElementById('add-keahlian-btn').style.display = 'inline-block';
            }

            updateDropdownOptions();
            toggleRemoveButtons();
        }
    });

    document.getElementById('keahlian-container').addEventListener('change', function(e) {
        if (e.target.classList.contains('keahlian-dropdown')) {
            updateDropdownOptions();
        }
    });

    toggleRemoveButtons();
</script>
