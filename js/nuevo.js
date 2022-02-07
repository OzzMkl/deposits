//clase para ingresar los datos del numero de cuenta
var ncb = {
    //beneficiario , banco, cuenta, transferencia
    "0": [""         , ""         , "",""],
    "1": ["BENJAMIN LUNA PEREZ", "SANTANDER", "65508346485", "014670655083464858"],
    "2": ["BENJAMIN LUNA PEREZ", "SANTANDER", "60511118083", "014670605111180834"],
    "3": ["BENJAMIN LUNA PEREZ", "BANAMEX", "44471225330", "002670444701225330"],
    "4": ["BENJAMIN LUNA PEREZ", "BANORTE", "0415276252", "072670004152762524"],
    "5": ["PATRICIO MARTINEZ JUAREZ", "SANTANDER", "65508189590", "014670655081895908"],
    "6": ["PATRICIO MARTINEZ JUAREZ", "BBVA", "00458202508", "0"]
  }
  
  function cambioOpciones()
  
  {
    var combo = document.getElementById('ncb');
    var cuenta = combo.value;
    
   
    document.getElementById('BENEFICIARIO').value = ncb[cuenta][0];
  
    document.getElementById('BANCO').value = ncb[cuenta][1];
  
    document.getElementById('CUENTA').value = ncb[cuenta][2];

    document.getElementById('TRANSFERENCIA').value = ncb[cuenta][3];
    
  
  }
/*
  function pregunta(){
    if (confirm('¿Estas seguro que quieres guardar esta informacion?')){
       document.tuformulario.submit()
    }
}*/