document.addEventListener("DOMContentLoaded", function() {
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
});