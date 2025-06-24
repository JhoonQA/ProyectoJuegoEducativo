//tomamos los elementos html
const txtPuntaje = document.querySelector("#puntos");
const nombre = document.querySelector("#nombre");
const nombreJugador = document.querySelector("#nombre-jugador");

nombre.innerHTML = localStorage.getItem("nombre");
nombreJugador.innerHTML = localStorage.getItem("nombre");

//Recupero el puntaje en caso que ya este jugando
let puntajeTotal = 0;
if(!localStorage.getItem("puntaje-total")){
    puntajeTotal = 0;
    txtPuntaje.innerHTML = puntajeTotal
}else{
    puntajeTotal = parseInt(localStorage.getItem("puntaje-total"));
    txtPuntaje.innerHTML = puntajeTotal;
}

//Vamos a necesitar una estructura para guardar las categorías ya jugadas
let categoriasJugadas;
//controlo si ya hay algo cargado en el localstorage cuando vuelvo de
//jugar (osea de juego.html) para cargar las categorías ya jugadas
const categoriasJugadasLS = JSON.parse(localStorage.getItem("categorias-jugadas"));
if(categoriasJugadasLS){
    categoriasJugadas = categoriasJugadasLS;
}else{//comienzo un arreglo vacío, todavía no hay ninguna categoría
    categoriasJugadas = [];
}
console.log(categoriasJugadas);

//Agrego un event listener click a todas las opciones de categoria
function agregarEventListenerOpciones(){
    const categorias = document.querySelectorAll(".categoria");
    categorias.forEach(categoria=>{
        categoria.addEventListener("click", (e)=>{
            console.log(e.currentTarget.id);
            //almaceno la categorìa que se eligiò en el Local Storage
            localStorage.setItem("categoria-actual", e.currentTarget.id);
            //Agrego al arreglo la categoría
            categoriasJugadas.push(e.currentTarget.id);
            localStorage.setItem("categorias-jugadas", JSON.stringify(categoriasJugadas));
            console.log(categoriasJugadas);
            //re dirijo a la pàgina del juego
            location.href = "juego.html";
        });
    });

    //desabilito las categorías que ya se jugaron
    categorias.forEach(categoria =>{
        if(categoriasJugadas.includes(categoria.id)){
            categoria.classList.add("desabilitada");
            categoria.classList.add("no-events");
        }
    })
}
agregarEventListenerOpciones();

class Pregunta {
    constructor(enunciado, opciones, indiceCorrecto, categoria) {
        this.enunciado = enunciado;
        this.opciones = opciones;
        this.indiceCorrecto = indiceCorrecto;
        this.categoria = categoria;
    }

    esCorrecta(respuestaUsuario) {
        return respuestaUsuario === this.indiceCorrecto;
    }
}

class BancoPreguntas {
    constructor() {
        this.preguntas = JSON.parse(localStorage.getItem("preguntas")) || [];
    }

    agregarPregunta(pregunta) {
        this.preguntas.push(pregunta);
        this.guardar();
    }

    eliminarPregunta(indice) {
        this.preguntas.splice(indice, 1);
        this.guardar();
    }

    editarPregunta(indice, nuevaPregunta) {
        this.preguntas[indice] = nuevaPregunta;
        this.guardar();
    }

    obtenerTodas() {
        return this.preguntas;
    }

    guardar() {
        localStorage.setItem("preguntas", JSON.stringify(this.preguntas));
    }
}

const banco = new BancoPreguntas();

let editando = false;
let indiceEditando = null;
// ================== LÓGICA DEL FORMULARIO ==================
document.getElementById("formPregunta").addEventListener("submit", function(e) {

    if (editando) {
    banco.editarPregunta(indiceEditando, nuevaPregunta);
    editando = false;
    indiceEditando = null;
} else {
    banco.agregarPregunta(nuevaPregunta);
}
    e.preventDefault();

    const enunciado = document.getElementById("enunciado").value;
    const opcionesInputs = document.querySelectorAll(".opcion");
    const opciones = Array.from(opcionesInputs).map(input => input.value);
    const indiceCorrecto = parseInt(document.getElementById("indiceCorrecto").value) - 1;
    const categoria = document.getElementById("categoria").value;

    if (indiceCorrecto < 0 || indiceCorrecto >= opciones.length) {
        alert("El índice de la respuesta correcta es inválido.");
        return;
    }

    const nuevaPregunta = new Pregunta(enunciado, opciones, indiceCorrecto, categoria);
    banco.agregarPregunta(nuevaPregunta);
    mostrarPreguntas();
    this.reset();

    function editarPregunta(i) {
    const p = banco.obtenerTodas()[i];
    document.getElementById("enunciado").value = p.enunciado;
    document.getElementById("categoria").value = p.categoria;
    document.getElementById("indiceCorrecto").value = p.indiceCorrecto + 1;

    // Limpiar opciones antiguas
    const opcionesInputs = document.querySelectorAll(".opcion");
    opcionesInputs.forEach(input => input.remove());

    p.opciones.forEach((opcion, idx) => {
        const input = document.createElement("input");
        input.type = "text";
        input.classList.add("opcion");
        input.value = opcion;
        input.placeholder = `Opción ${idx + 1}`;
        document.getElementById("formPregunta").insertBefore(input, document.getElementById("agregarOpcion"));
        document.getElementById("formPregunta").insertBefore(document.createElement("br"), document.getElementById("agregarOpcion"));
    });

    editando = true;
    indiceEditando = i;
}

});

// Agregar campo de opción adicional
document.getElementById("agregarOpcion").addEventListener("click", () => {
    const nueva = document.createElement("input");
    nueva.type = "text";
    nueva.classList.add("opcion");
    nueva.placeholder = `Opción ${document.querySelectorAll(".opcion").length + 1}`;
    document.getElementById("formPregunta").insertBefore(nueva, document.getElementById("agregarOpcion"));
    document.getElementById("formPregunta").insertBefore(document.createElement("br"), document.getElementById("agregarOpcion"));
});

// Mostrar preguntas guardadas
function mostrarPreguntas() {
    const lista = document.getElementById("listaPreguntas");
    lista.innerHTML = "";

    banco.obtenerTodas().forEach((p, i) => {
        const li = document.createElement("li");
        li.innerHTML = `
            <strong>${p.enunciado}</strong> (${p.categoria})<br>
            Opciones: ${p.opciones.join(", ")}<br>
            Respuesta correcta: ${p.opciones[p.indiceCorrecto]}<br>
            <button onclick="eliminarPregunta(${i})">Eliminar</button>
        `;
        lista.appendChild(li);
        li.innerHTML = `
    <strong>${p.enunciado}</strong> (${p.categoria})<br>
    Opciones: ${p.opciones.join(", ")}<br>
    Respuesta correcta: ${p.opciones[p.indiceCorrecto]}<br>
    <button onclick="eliminarPregunta(${i})">Eliminar</button>
    <button onclick="editarPregunta(${i})">Editar</button>
`;


    });
}

function eliminarPregunta(i) {
    banco.eliminarPregunta(i);
    mostrarPreguntas();
}

window.onload = mostrarPreguntas;



