// Mendapatkan tombol
const swipeUpBtn = document.getElementById("swipeUpBtn");

// Menampilkan tombol ketika pengguna menggulir ke bawah
window.onscroll = function() {
    if (document.body.scrollHeight - window.scrollY <= window.innerHeight + 100) {
        swipeUpBtn.style.display = "block"; // Tampilkan tombol
    } else {
        swipeUpBtn.style.display = "none"; // Sembunyikan tombol
    }
};

// Menambahkan fungsi untuk menggulir ke atas
swipeUpBtn.addEventListener("click", function() {
    window.scrollTo({
        top: 0,
        behavior: "smooth" // Efek scroll halus
    });
});