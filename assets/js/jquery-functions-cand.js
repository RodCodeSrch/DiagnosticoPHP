$(function(){
    getStateVotes();
})

/**
 * Esta función permite listar el estado de votos por candidato en la vista "vista_candidatos.php"
 */

// Listar estado votaciones
function getStateVotes(){
    var dir = ""; 
    var refdata= "codparam=estado_votaciones";
    dir = DataBaseUrl + 'procesa/proVote.php';
     $.post(dir, refdata,
     function(respdata) {
        var obj = jQuery.parseJSON(respdata);
        if(obj.status){
            var dataStateVot = obj.data;
            $("#ViewListStateVot").html(dataStateVot);                      
        }
    });   
  }