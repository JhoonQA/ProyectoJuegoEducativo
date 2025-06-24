
// ejecutar funcion en_el evento clic

document.getElementById("btn_open").addEventListener("click",open_close_menu);

// variables
var aside_menu = document.getElementById("menu_aside");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");

//funcion menu mostrar/ocultar
    function open_close_menu(){
        body.classList.toggle("body_move");
        aside_menu.classList.toggle("menu__aside_move");
    }


    if(window.innerWidth < 750) {
        body.classList.add("body_move");
        aside_menu.classList.add("menu__aside_move"); 
    }

    // menu responsive

    window.addEventListener("resize",function(){

        if(window.innerWidth > 750 ){
            body.classList.remove("body_move");
            aside_menu.classList.remove("menu__aside_move");
        }

        if(window.innerWidth < 750 ){
            body.classList.add("body_move");
            aside_menu.classList.add("menu__aside_move");
        }

    });