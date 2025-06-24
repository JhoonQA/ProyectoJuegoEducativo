let preguntasUsuario = JSON.parse(localStorage.getItem("preguntasPersonalizadas")) || [];

function guardarPregunta(event) {
    event.preventDefault();
    const id = document.getElementById("idPregunta").value || Date.now();
    const pregunta = {
        id: parseInt(id),
        categoria: document.getElementById("categoria").value,
        titulo: document.getElementById("titulo").value,
        opcionA: document.getElementById("opcionA").value,
        opcionB: document.getElementById("opcionB").value,
        opcionC: document.getElementById("opcionC").value,
        opcionD: document.getElementById("opcionD").value,
        correcta: document.getElementById("correcta").value.toLowerCase()
    };

    const index = preguntasUsuario.findIndex(p => p.id === pregunta.id);
    if (index >= 0) {
        preguntasUsuario[index] = pregunta;
    } else {
        preguntasUsuario.push(pregunta);
    }

    localStorage.setItem("preguntasPersonalizadas", JSON.stringify(preguntasUsuario));
    limpiarFormulario();
    renderizarTabla();
}

function limpiarFormulario() {
    document.getElementById("formulario").reset();
    document.getElementById("idPregunta").value = "";
    document.getElementById("enlaceGenerado").value = "";
}

function renderizarTabla() {
    const tabla = document.getElementById("tablaPreguntas");
    tabla.innerHTML = "";
    preguntasUsuario.forEach(p => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${p.id}</td>
            <td>${p.categoria}</td>
            <td>${p.titulo}</td>
            <td>
                <button onclick="editarPregunta(${p.id})">Editar</button>
                <button onclick="eliminarPregunta(${p.id})">Eliminar</button>
                <button onclick="generarEnlace(${p.id})">Generar Enlace</button>
            </td>`;
        tabla.appendChild(fila);
    });
}

function editarPregunta(id) {
    const p = preguntasUsuario.find(p => p.id === id);
    if (!p) return;
    document.getElementById("idPregunta").value = p.id;
    document.getElementById("categoria").value = p.categoria;
    document.getElementById("titulo").value = p.titulo;
    document.getElementById("opcionA").value = p.opcionA;
    document.getElementById("opcionB").value = p.opcionB;
    document.getElementById("opcionC").value = p.opcionC;
    document.getElementById("opcionD").value = p.opcionD;
    document.getElementById("correcta").value = p.correcta;
}

function eliminarPregunta(id) {
    preguntasUsuario = preguntasUsuario.filter(p => p.id !== id);
    localStorage.setItem("preguntasPersonalizadas", JSON.stringify(preguntasUsuario));
    renderizarTabla();
}

function generarEnlace(id) {
    const enlace = `${window.location.origin}/juego.html?pid=${id}`;
    document.getElementById("enlaceGenerado").value = enlace;
}

document.getElementById("formulario").addEventListener("submit", guardarPregunta);
renderizarTabla();
