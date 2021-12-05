var doc,ace;
var keys = {};
var llenguatge;
var actual_doc="";
var second_doc="";
window.onload = function() {
  if (ace===undefined) {return false;}
  editor = ace.edit("editor");
  editor.setTheme("ace/theme/monokai");
  editor.session.setMode("ace/mode/c_cpp");
  window.addEventListener("keydown", function(event) {
    keys[event.code] = true;
    if((event.ctrlKey || event.metaKey) && keys["KeyS"]) {
      event.preventDefault();
      save();
    }
  });
  editor.setOptions({
      enableBasicAutocompletion: true,
      enableSnippets: true,
      enableLiveAutocompletion: false
  });
    
}

function generateToken() {
  $.ajax({

    url: "/Model/tokenGenerator.php",
    success: function(response) {
        document.getElementById("myInput").value = "http://localhost/index.php?query=3&token="+response;
    }
})
}
function copiado() {
  var copyTextarea = document.getElementById("myInput");
  copyTextarea.select(); //select the text area
  document.execCommand("copy"); //copy to clipboard
  $(".message").text("Link copiat!");
  }

function post(url,data,callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        callback(this.responseText);
      }
    };
    xhr.open("POST", 'Model/' + url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(typeof data === "object") {
      var newObj = "";
      for(var i in data) {
        newObj += i + '=' + data[i];
        if(Object.keys(data).indexOf(i) !== Object.keys(data).length-1) {
          newObj += "&";
        }
      }
      data = newObj;
      
    }
    //console.log(data);
    xhr.send(encodeURI(data));
  }


  function setLanguage(language) {
    editor = ace.edit("editor");
    if(language == 'C++'){
      llenguatge="cpp";
      editor.session.setMode("ace/mode/c_cpp");
      //editor.setValue("sd");
  }
  else if(language == 'Python') {
      llenguatge="python";
      editor.session.setMode("ace/mode/python");
      //editor.setValue("print('hello world')");
  }

}

function executeCode() {

    console.log(myVariable);
    console.log(actual_doc);
    if (actual_doc=="") {
      console.log("Entra al pete");
      $(".output").text("Selecciona el fitxer per executar");
      return false;
    }
    $.ajax({

        url: "/app/compiler.php",

        method: "POST",

        data: {
            language: llenguatge,
            code: editor.getSession().getValue(),
            route: myVariable,
            ejecutable:actual_doc
        },

        success: function(response) {
            $(".output").text(response)
        }
    })
}
function validarRegistro(){
    var nombre,apellido,correo,contraseña,error,contraseña2,reg,exRegPassword,exRegUser,re;
    exRegUser=/^(?=.*\d)(?=.*[a-z])[0-9a-z]{6,16}$/;
    exRegPassword="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
     re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    exRegPassword=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
    nombre=document.getElementById("first_name").value;
    apellido=document.getElementById("last_name").value;
    correo=document.getElementById("email").value;
    contraseña=document.getElementById("password").value;
    contraseña2=document.getElementById("password_confirmation").value;
    error=document.getElementById("error_mssg");
    reg=/^[A-Z]+$/i;


    
    if(nombre==""||apellido==""||contraseña==""||correo=="")
    {
        alert("Faltan campos por rellenar");
        error.classList.remove('hide');
        error.innerHTML="Hay campos vacios revisalos ";
        return false;
    }else if (nombre.length > 30 || apellido.length>30){ 
        error.classList.remove('hide');
        error.innerHTML="Nombre o apellidos incorrectos ";
        return false;
    }else if (correo.length>100){
        error.classList.remove('hide');
        error.innerHTML="El correo es demasiado largo ";
        return false;
    }else if (contraseña.length<8 || contraseña.length>24||contraseña2.length<8 || contraseña2.length>40){
        error.classList.remove('hide');
        error.innerHTML="La contraseña debe ser mayor de 8 caracteres ";
        return false;
    }else if (contraseña!=contraseña2){
        error.classList.remove('hide');
        error.innerHTML="Las contraseñas no son iguales";
        return false;
    }else if (!re.test(correo)){
        error.classList.remove('hide');
        error.innerHTML="El correo falla";
        return false;
    }else if (!exRegPassword.test(contraseña)){
        error.classList.remove('hide');
        error.innerHTML="La contraseña debe contener almenos una Mayuscula,una minuscula y un numero";
        return false;
    }else if(!reg.test(nombre))
    {
        error.classList.remove('hide');
        error.innerHTML="El nombre solo puede contener letras";
        return false;
    }
    else if(!reg.test(apellido))
    {
        error.classList.remove('hide');
        error.innerHTML="El apellido solo puede contener letras";
        return false;
    }
    if (error.innerText=="El correo ya existe"){
        error.classList.remove('hide');
        return false;
    }
}

function validarLogin(){
    var nombre,contraseña,error,exRegPassword;
    nombre=document.getElementById("email").value;
    contraseña=document.getElementById("password").value;
    error=document.getElementById("error_mssg");
    exRegPassword="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
    console.log(nombre);
    if(nombre==""||contraseña=="")
    {
        alert("Faltan campos por rellenar");
        error.classList.remove('hide');
        error.innerHTML="Hay campos vacios ";
        return false;
    }else if (nombre.length > 40){
        //alert("El  nombre o apellido es muy largo");
        error.classList.remove('hide');
        error.innerHTML="Email demasiado largo ";
        return false;
    }else if (contraseña.length<8 || contraseña.length>24){
        alert("La contraseña no cumple con los requisitos");
        error.classList.remove('hide');
        error.innerHTML="El tamaño de la contraseña debe tener entre 8 y 24 caracteres ";
        return false;
    }else if (!exRegPassword.test(contraseña)){
        error.classList.remove('hide');
        error.innerHTML="La contraseña esta mal";
        return false;
    }


}


function validarProblema(){
  var titulo,descripcion;
  titulo=document.getElementById("exampleFormControlInput1").value;
  descripcion=document.getElementById("exampleFormControlTextarea1").value;
  error=document.getElementById("error_mssg");
  if(titulo==""||descripcion=="")
  {
      alert("Faltan campos por rellenar");
      error.classList.remove('hide');
      error.innerHTML="Hay campos vacios ";
      return false;
  }else if (titulo.length < 3|| titulo.length>80){
    //alert("El  nombre o apellido es muy largo");
    error.classList.remove('hide');
    error.innerHTML="Titulo demasiado corto";
    return false;
}else if (descripcion.length<3 ){
    //alert("La Descripcion es demasiado corta");
    error.classList.remove('hide');
    error.innerHTML="Descripcion demasiado corta";
    return false;
}

  var control = document.getElementById("customFile");
  var filelength = control.files.length;
  if(filelength==0){
    alert("Selecciona els arxius del problema");
    error.classList.remove('hide');
    error.innerHTML="Selecciona els arxius del problema";
    return false;
  }
  for (var i = 0; i < control.files.length; i++) {
    var file = control.files[i];
    var FileName = file.name;
    var FileExt = FileName.substr(FileName.lastIndexOf('.'));
    var extensiones=FileExt.toUpperCase();
    var allowedExtensionsRegx = /(\.cpp|\.h|\.py|\.python)$/i;
    var isAllowed = allowedExtensionsRegx.test(FileExt);
    if (!isAllowed) {
      console.log(FileExt);
      error.classList.remove('hide');
      error.innerHTML="El format dels arxius "+ FileExt +  " es incorrecte";
      return false;
    }
  }

  console.log(titulo);
  console.log(descripcion);
  return true;
}


function newFile() {
    console.log("nevo archivo");
    var filename = prompt("Enter the file/folder name");

    if(filename) {
      post("newFile.php", {filename, dir}, function(data) {
        if(data == true) {
          openFolder(dir);
        }
        else {
          console.log(data);
        }
        closeMenu();
      });
    }
  }

  function openFile(file) {
    second_doc=file;
    if (second_doc!="") {
    post("archivo.php", {file:file}, function(data) {
      doc = file;
      saved = data;
      //document.getElementById("file").textContent = doc.split('/').pop();
      valor=doc.split('.').pop();
 
      actual_doc=doc.split('/').pop();
      console.log(valor);
      editor.setValue(data, -1);
      if (valor=="cpp") {
        editor.session.setMode("ace/mode/c_cpp"); //HACER SUBSTRING DEL FILE Y COGER EL DATO
      }else{
        editor.session.setMode("ace/mode/python"); //HACER SUBSTRING DEL FILE Y COGER EL DATO
      }
      
    });
  }
  }
  function openFiler() {
    if (second_doc!="") {
      openFile(second_doc);
    }
    
  }
  function myStopFunction() {
    clearInterval(myVar);
}


  function openFolder(folder) {
    console.log("Carpeta a abrir");
    console.log(folder);
    post("dir.php", {folder:folder}, function(data) {
      dir = folder;
      document.getElementById('files').innerHTML = data;
    });
  }

  function save() {
    if(doc === undefined) {return false;}

    $.ajax({

      url: "/Model/save.php",

      method: "POST",

      data: {
          file: doc,
          code: editor.getSession().getValue()
      },

      success: function(response) {
        if(response === 'true') {
          saved = editor.getSession().getValue();
        }else{
          console.log(response);
        }

      }
  })
  }

  function openRightMenu() {
    document.getElementById("rightMenu").style.display = "block";
  }
  
  function closeRightMenu() {
    document.getElementById("rightMenu").style.display = "none";
  }


    
