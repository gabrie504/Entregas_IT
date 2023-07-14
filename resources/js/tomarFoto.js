var tomarFotoBtn = document.getElementById("tomar-foto-btn");
var eliminarFotoBtn = document.getElementById("eliminar-foto-btn");
var fotoEntregaInput = document.getElementById("foto_entrega");
var previewFoto = document.getElementById("preview-foto");
var previewImg = document.getElementById("preview-img");
var crearEntregaBtn = document.getElementById("crear-entrega-btn");
var indicadorCreacion = document.getElementById("indicador-creacion");

tomarFotoBtn.addEventListener("click", function() {
    fotoEntregaInput.click();
});

fotoEntregaInput.addEventListener("change", function() {
    var file = this.files[0];

    if (file && file.type.startsWith("image/")) {
        var reader = new FileReader();
        reader.onload = function(event) {
            previewImg.src = event.target.result;
            previewFoto.style.display = "block";
            eliminarFotoBtn.style.display = "block";
            crearEntregaBtn.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
});

eliminarFotoBtn.addEventListener("click", function() {
    fotoEntregaInput.value = "";
    previewImg.src = "#";
    previewFoto.style.display = "none";
    eliminarFotoBtn.style.display = "none";
    crearEntregaBtn.style.display = "none";
});
