$(function(){
  $('#cash').keyup(function(){
    var cash = $('#cash').val();
    var total = {{$totalprice}}
    var kusur = cash - total;
    var fixedkusur = kusur.toFixed(2);
    if (cash < total) {
      $('#regjistro').prop("disabled", true);
    }else{
      $('#kusur').html(fixedkusur);
      $('#regjistro').prop("disabled", false);
    }
  });


  // Disable pay button if cart is empty
  if ({{count($mycart)}} == 0) {
    $('#modalclick').prop("disabled",true).html("Ska produkte!");
  }


  // Jquery autocomplete
  $( "#search" ).autocomplete({
    source: 'http://localhost:8000/search'
  });


  // Add hot keys
  $(document).keydown(function(e){
    if ((e.keyCode == 13) && e.ctrlKey) {
       $("#modalclick").click();
       $("#cash").show().focus();
       $("#cash").select();
       return false;
    }
    if (e.keyCode == 114) {
       $("#search").show().focus();
       return false;
    }
    if (e.keyCode == 115) {
       $("#qty").show().focus();
       $("#qty").select();
       return false;
    }
    if (e.keyCode == 117) {
       $("#disc").show().focus();
       $("#disc").select();
       return false;
    }
  });

  //Disable keyboard on modal
  $('.modal').modal({
        show: false,
        keyboard: false,
        backdrop: 'static'
  });
});
