
/**
 * Esta función obtiene los votos en el sistema y los carga a la vista de "vista_votos.php"
 */
async function getData(){
  try{
    let dataResponse = await fetch("http://localhost/DiagnosticoPHP/procesa/proVote.php?codparam=listar");
    jsonData = await dataResponse.json();
    if(jsonData.status){
      let refdata = jsonData.data;
      document.querySelector("#ViewListVot").innerHTML = '';
      refdata.forEach((item) => {
        let newdatatr = document.createElement("tr");
        newdatatr.id = "row_" + item.IdVot;
        newdatatr.innerHTML = `<tr>
                                <th scope="row">${item.IdVot}</th>
                                <td>${item.VotDNI}</td>
                                <td>${item.VotNombre}</td>
                                <td>${item.VotAlias}</td>
                                <td>${item.VotMail}</td>
                                <td>${item.Community}</td>
                                <td>${item.Candidato}  - ${item.Partido} </td>                                
                                <td>${item.referTitles}</td>
                                <td>${item.options}</td>`;
                                document.querySelector("#ViewListVot").appendChild(newdatatr);
      });
    } 
    //console.log(jsonData);
  }catch(err){
    console.log("Ocurrio un error: " + err);
  }
}

getData();

/**
 * Esta función permite entregar un mensaje pre-eliminación de un registro al usuario.
 * @param [Number] Id ID de registro a eliminar.
 */
function AlertDeletVot(id){
  swal({
    title: "Atención!",
    text: "¿Decea realmente eliminar el registro? " ,
    icon: "warning",
    //buttons: true,
    buttons: ["Volver", "Continuar!"],
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      DeletData(id);
    } else {
      swal({
        title: "En hora buena!",
        text: "La información del documento no a sido modificada.",
        icon: "success",
      });
    }
});
}

/**
 * Esta función elimina un registro de votación.
 * @param {Number} Id de votación a eliminar
 * 
 */
async function DeletData(id){
  try{
    let formData = new FormData();
    formData.append('datacod', id);
    let resp = await fetch("http://localhost/DiagnosticoPHP/procesa/proVote.php?codparam=borrar",{
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
   
    jsonData = await resp.json();
    if(jsonData.status){
      getData();
      swal({
        title: "En hora buena!",
        text: jsonData.MsgData,
        icon: "success",
      });
      
    }else{
      swal({
        title: "Error",
        text: jsonData.MsgData,
        icon: "error",
      });
    }

  }catch(err){
     console.log("ha ocurrido un error " + err);
  }
}


// JQuery
$(function(){
   getListStateRefers();
});

/**
 * Esta función permite listar el estado de referencias en la vista "vista_votos.php"
 */
function getListStateRefers(){
  var dir = ""; 
  var refdata= "codparam=estado_referencias";
  dir = DataBaseUrl + 'procesa/proVote.php';
   $.post(dir, refdata,
   function(respdata) {
      var obj = jQuery.parseJSON(respdata);
      if(obj.status){
          var dataRef = obj.data;
          $("#ViewReferData").html(dataRef);
      }
  });   
}


