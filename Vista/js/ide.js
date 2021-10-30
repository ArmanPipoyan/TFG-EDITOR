window.onload = function() {
    editor = ace.edit("editor");
    //openFolder("./../app/problemes/Qa Tester3");
    editor.setTheme("ace/theme/monokai");
    //editor.setValue("include <iostrem>");
    //editor.insert("Proba beta de codi");
    editor.session.setMode("ace/mode/c_cpp");
    editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: false
    });
    
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
    xhr.send(encodeURI(data));
  }

function changeLanguage() {

    let language = $("#languages").val();
    if(language == 'cpp'){
        editor.session.setMode("ace/mode/c_cpp");
        //editor.setValue("sd");
    }
    else if(language == 'python') {
        editor.session.setMode("ace/mode/python");
        //editor.setValue("print('hello world')");
    }
    //Cargamos el dato en el archivo
    $.ajax({

        url: "/Vista/resources/getFile.php",

        method: "POST",

        data: {
            language: $("#languages").val(),
            code: editor.getSession().getValue()
        },

        success: function(response) {
            editor.setValue(response);
        }
    })

}

function executeCode() {
    console.log($("#languages").val());
    $.ajax({

        url: "/app/compiler.php",

        method: "POST",

        data: {
            language: $("#languages").val(),
            code: editor.getSession().getValue()
        },

        success: function(response) {
            $(".output").text(response)
        }
    })
}
function validarRegistro(){
    var nombre,apellido,correo,usuario,contraseña,expersion,error,contraseña2,reg,exRegPassword,exRegUser,re;
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

    var isChecked = document.getElementById('my_checkbox').checked;
    var the_value = isChecked ? "Professor" : "Estudiant";

    console.log(the_value);
    
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
    var nombre,apellido,contraseña,error,exRegPassword,exRegUser;
    nombre=document.getElementById("nombre").value;
    contraseña=document.getElementById("contraseña").value;
    error=document.getElementById("error_mssg");
    exRegPassword="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"

    if(nombre==""||contraseña=="")
    {
        alert("Faltan campos por rellenar");
        error.classList.remove('hide');
        error.innerHTML="Hay campos vacios miratelos ";
        return false;
    }else if (nombre.length > 30){
        alert("El  nombre o apellido es muy largo");
        error.classList.remove('hide');
        error.innerHTML="Nombre o apellidos incorrectos ";
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

    post("archivo.php", {file:file}, function(data) {
      doc = file;
      saved = data;
      //document.getElementById("file").textContent = doc.split('/').pop();
      valor=doc.split('.').pop();
      console.log(valor);
      editor.setValue(data, -1);
      if (valor=="cpp") {
        editor.session.setMode("ace/mode/c_cpp"); //HACER SUBSTRING DEL FILE Y COGER EL DATO
      }else{
        editor.session.setMode("ace/mode/python"); //HACER SUBSTRING DEL FILE Y COGER EL DATO
      }
      
    });
  }



  function openFolder(folder) {

    post("dir.php", {folder:folder}, function(data) {
      dir = folder;
      document.getElementById('files').innerHTML = data;
    });
  }