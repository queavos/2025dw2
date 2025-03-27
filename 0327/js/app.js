let especies = []; //declare array especies
const tablaBody = document.querySelector("#tabla-especies tbody");

cargarDatosDePrueba();
//console.log(especies);
mostrarTabla();
limpiarFormulario(); 

/* FUCNIONES  SOBRE ARRAY */ 
function agregarEspecie(){
    console.log("agregarEspecie");
      let dato = {
				id: Date.now(),
				nombre: document.querySelector("#nombre").value,
				nombreCientifico: document.querySelector("#nombreCientifico").value,
				habitat: document.querySelector("#habitat").value,
				informacionExtra: document.querySelector("#informacionExtra").value,
			};
      console.log(dato);
      especies.push(dato);
      mostrarTabla();
      limpiarFormulario();      
    
}
function eliminarEspecie(id){
  especies=especies.filter(especie=>especie.id!==id);
  mostrarTabla();
}   
function editarEspecie(id){
const datos=especies.find(especie=>especie.id===id);
document.querySelector("#nombre").value=datos.nombre;
document.querySelector("#nombreCientifico").value=datos.nombreCientifico;   
document.querySelector("#habitat").value=datos.habitat;
document.querySelector("#informacionExtra").value=datos.informacionExtra;
document.querySelector("#id").value=datos.id;
document.querySelector("#guardar").innerText="Actualizar";
//document.querySelector("#guardar").setAttribute("onclick", "actualizarEspecie()");
document.querySelector("#guardar").addEventListener("click",()=>actualizarEspecie());
}  
function actualizarEspecie(){
    //preventDefault();
    console.log("actualizarEspecie");
    let datos={id: document.querySelector("#id").value,
               nombre: document.querySelector("#nombre").value,
               nombreCientifico: document.querySelector("#nombreCientifico").value,
               habitat: document.querySelector("#habitat").value,
               informacionExtra: document.querySelector("#informacionExtra").value
              };
    console.log(datos);          
    const idx=especies.findIndex(especie=>especie.id==datos.id);
    console.log(idx);
    especies[idx]=datos;  
    console.log(especies);        
    mostrarTabla();
    limpiarFormulario();  
}

/* funciones de interfaz */
function mostrarTabla(){
    tablaBody.innerHTML = "";
    
    especies.forEach(especie => {
        //console.log("entro")
        ///console.log(especie);
        tablaBody.innerHTML += `
             <tr>
              
            <td>${especie.nombre}</td>
            <td>${especie.nombreCientifico}</td>
            <td>${especie.habitat}</td>
            <td>${especie.informacionExtra}</td>
            <td>
                <button onclick="editarEspecie(${especie.id})">Editar</button>
                <button onclick="eliminarEspecie(${especie.id})">Eliminar</button>
            </td>
        </tr>
        `;
    });
}
function mostrarFormulario(){}
function limpiarFormulario(){
    document.querySelector("#nombre").value="";
    document.querySelector("#nombreCientifico").value="";
    document.querySelector("#habitat").value="";
    document.querySelector("#informacionExtra").value="";
    document.querySelector("#id").value="";
    document.querySelector("#guardar").innerText="Guardar";
    document.querySelector("#guardar").removeEventListener("click",()=>actualizarEspecie());
    document.querySelector("#guardar").addEventListener("click",()=>agregarEspecie());
}

/* funciones otras */
function cargarDatosDePrueba(){
const datosPrueba = [
	{
		id: 1,
		nombre: "Perro",
		nombreCientifico: "can domesticus",
		habitat: "domestico",
		informacionExtra: "domestico ladrador",
	},
	{
		id: 2,
		nombre: "Jaguar",
		nombreCientifico: "panthera onca",
		habitat: "selva",
		informacionExtra: "si te sale corre",
	},
	{
		id: 3,
		nombre: "Guacamayo azul y amarillo",
		nombreCientifico: "ara ararauna",
		habitat: "selvas humedas",
		informacionExtra: "Blu te busca",
	},
	{
		id: 4,
		nombre: "Tucan",
		nombreCientifico: "Ramphastos toco",
		habitat: "selvas humedas",
		informacionExtra: "Toco te busca",
	},
];
especies=datosPrueba;
}
