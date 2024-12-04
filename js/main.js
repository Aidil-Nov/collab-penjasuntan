/*=============== SHOW MENU ===============*/
const showMenu = (toggleId, navId) => {
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId)

    toggle.addEventListener('click', () => {
        // Add show-menu class to nav menu
        nav.classList.toggle('show-menu')

        // Add show-icon to show and hide the menu icon
        toggle.classList.toggle('show-icon')
    })
}

showMenu('nav-toggle', 'nav-menu');

// Mendapatkan referensi tombol dan kontainer PDF
const showPDFBtn = document.getElementById("showPDFBtn");
const pdfContainer = document.getElementById("pdf-container");
const closePDFBtn = document.getElementById("closePDFBtn");

// Menambahkan event listener untuk tombol tampilkan PDF
showPDFBtn.addEventListener("click", function() {
    pdfContainer.style.display = "flex"; // Menampilkan PDF
});

// Menambahkan event listener untuk tombol tutup PDF
closePDFBtn.addEventListener("click", function() {
    pdfContainer.style.display = "none"; // Menyembunyikan PDF
});

// Menutup PDF saat mengklik area di luar modal
pdfContainer.addEventListener("click", function(event) {
    if (event.target === pdfContainer) {
        pdfContainer.style.display = "none";
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll(".nav-link a");

    navLinks.forEach(link => {
        link.addEventListener("click", function() {
            navLinks.forEach(nav => nav.classList.remove("active"));
            this.classList.add("active");
        });
    });
});