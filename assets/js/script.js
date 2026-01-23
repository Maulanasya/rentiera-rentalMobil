document.addEventListener("DOMContentLoaded", function() {
    const pelangganEL = document.querySelector('.pelanggan');
    if (!pelangganEL) return; 

    let count = 0; //nilai awal 
    const target = 200; //nilai akhir
    const speed = 10; //kecepatan animasi

    function updateCounter() {
        count++; 
        pelangganEL.textContent = count + "+"; 
        if (count < target) { 
            setTimeout(updateCounter, speed);
        }
    }
    updateCounter();
});

// unit mobil tersedia
document.addEventListener("DOMContentLoaded", function() {
    const unitEL = document.querySelector('.unit');
    if (!unitEL) return; 

    let count = 0;
    const target = 100;
    const speed = 30; 

    function updateCounter() {
        count++;
        unitEL.textContent = count + "+";
        if (count < target) {
            setTimeout(updateCounter, speed);
        }
    }

    updateCounter();
});

// tahun berdiri
document.addEventListener("DOMContentLoaded", function() {
    const tahunEL = document.querySelector('.tahun');
    if (!tahunEL) return; 

    let count = 0;
    const target = 10;
    const speed = 100; 

    function updateCounter() {
        count++;
        tahunEL.textContent = count + "+";
        if (count < target) {
            setTimeout(updateCounter, speed);
        }
    }

    updateCounter();
});

// sewa
function hitungOtomatis(id) {
    // elemen input
    const tglMulai = document.getElementById('tglMulai' + id).value;
    const durasi = parseInt(document.getElementById('durasi' + id).value);
    const hargaHarian = parseInt(document.getElementById('hargaHarian' + id).value);

    // elemen tampilan
    const tglKembaliTampil = document.getElementById('tglKembali' + id);
    const totalTampil = document.getElementById('tampilTotal' + id);
    
    // elemen hidden input (Untuk Database)
    const inputTotal = document.getElementById('inputTotal' + id);
    const inputKembali = document.getElementById('inputKembali' + id);

    if (tglMulai && durasi > 0) {
        // Logika Hitung Tanggal
        let date = new Date(tglMulai);
        date.setDate(date.getDate() + durasi);
        
        let dd = String(date.getDate()).padStart(2, '0');
        let mm = String(date.getMonth() + 1).padStart(2, '0');
        let yyyy = date.getFullYear();
        tglKembaliTampil.innerText = dd + '/' + mm + '/' + yyyy;
        totalTampil.innerText = 'Rp ' + (durasi * hargaHarian).toLocaleString('id-ID');
        inputKembali.value = yyyy + '-' + mm + '-' + dd;
        inputTotal.value = durasi * hargaHarian;
    } else {
        tglKembaliTampil.innerText = '-';
        totalTampil.innerText = 'Rp 0';
    }
}

