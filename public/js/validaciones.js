var alertList = document.querySelectorAll('.alert')
alertList.forEach(function (alert) {
  new bootstrap.Alert(alert)
})

//Validar Login
function login(obj) {
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe ingresar su nombre de usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    if (username.length < 3){
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "¡Parece que faltan algunos dígitos en el usuario que ingresaste!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return (false);
    }
    var contraseña = obj.contraseña.value;
    if (!contraseña) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe  ingresar su contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.contraseña.focus();
        return false;
    }
    if (contraseña.length < 4){
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "¡Parece que faltan algunos dígitos en la contraseña que ingresaste!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.contraseña.focus();
		return (false);
	}
    
}

//Validar Login boton del correo
function Email(obj) {
    var email_login= obj.email_login.value;
    if (!email_login) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe ingresar su correo",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
 
        obj.email_login.focus();
        return false;
    }

    if (email_login.trim() == "") {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "El campo de gmail no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email_login.focus();
        return false;
    }

    if (/^([a-zA-Z0-9])\1+$/.test(email_login)) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "El campo de gmail no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.email_login.focus();
        return false;
    }
    
}

//Validar Registro de USUARIO
function registrousuario(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un nombre",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }
    if (name.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return (false);
    }
    if (name.trim() == "") {
        Swal.fire({
           title: 'Registro de Usuario',
           text: "El campo de nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
      
       obj.name.focus();
       return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(name)) {
         Swal.fire({
            title: 'Registro de Usuario',
            text: "El campo de nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.name.focus();
        return false;
    }
    if (!/^[A-Z][a-z]+$/.test(name)) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.name.focus();
        return false;
    }
    var nameA = obj.nameA.value;
    if (!nameA) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un apellido",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nameA.focus();
        return false;
    }
    if (nameA.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nameA.focus();
        return (false);
    }
    if (nameA.trim() == "") {
        Swal.fire({
           title: 'Registro de Usuario',
           text: "El campo de nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
      
       obj.nameA.focus();
       return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(nameA)) {
         Swal.fire({
            title: 'Registro de Usuario',
            text: "El campo de nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nameA.focus();
        return false;
    }
    if (!/^[A-Z][a-z]+$/.test(nameA)) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nameA.focus();
        return false;
    }
    var email = obj.email.value;
    if (!email) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un e-mail",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email.focus();
        return false;
    }
    if (email.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.email.focus();
        return (false);
    }
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un nombre de usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    if (username.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texo.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return (false);
    }
    // var rol = obj.rol.value;
    // if (rol==0){
    //     alert("Debe de seleccionar el Rol del Usuario");
    //     return (false);
    // }
    var password = obj.password.value;
    if (!password) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password.focus();
        return false;
    }
    if (password.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texo o numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
		
		obj.password.focus();
		return (false);
	}
    var password_confirmation = obj.password_confirmation.value;
    if (!password_confirmation) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar la confirmación de la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password_confirmation.focus();
        return false;
    }
    if (password_confirmation.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto o numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
	
		obj.password_confirmation.focus();
		return (false);
	}
    if (password_confirmation != password) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Las contraseñas no coinciden",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password_confirmation.focus();
        return false;
    }
    
}

//Validar Roles
function roles(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Rol',
            text: "Debe de ingresar el nombre del rol.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }
    if (name.length < 2){
		Swal.fire({
            title: 'Rol',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.name.focus();
		return (false);
	}
    if (name.trim() == "") {
        Swal.fire({
            title: 'Rol',
            text: "El campo de rol no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }

    if (/(\w)\1+/i.test(name.toLowerCase())) {
    Swal.fire({
            title: 'Rol',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre.focus();
        return false;
    }

}

//Validar Usuario
function usuario(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el nombre del usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }
    if (name.length < 3){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.name.focus();
		return (false);
	}
    if (name.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de nombre del usuario no debe contener solo espacios en blnacos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }

    if (/(\w)\1+/i.test(name.toLowerCase())) {
    Swal.fire({
            title: 'Usuario',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre.focus();
        return false;
    }

    var email = obj.email.value;
    if (!email) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el e-mail",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
    
        obj.email.focus();
        return false;
    }
    if (email.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.email.focus();
		return (false);
	}
    if (email.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de e-mail no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.email.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(email)) {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de e-mail no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.version.focus();
        return false;
    }
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    if (username.length < 2){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.username.focus();
		return (false);
	}
    if (username.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de usuario no debe contener solo espacios en blnacos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(username)) {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de usuario no debe contener solo caracteres repetidos",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    var password = obj.password.value;
    if (!password) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar la contraseña.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password.focus();
        return false;
    }
    if (password.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.password.focus();
		return (false);
	}
    if (password.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de Contraseña no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password.focus();
        return false;
    }
    // if (/^([a-zA-Z0-9])\1+$/.test(password)) {
    //     alert("El Campo Contraseña no debe contener solo Caracteres Repetidos.");
    //     obj.version.focus();
    //     return false;
    // }
    var confirm_password = obj.confirm_password.value;
    if (!confirm_password) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar la confirmación de la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.confirm_password.focus();
        return false;
    }
    if (confirm_password.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.confirm_password.focus();
		return (false);
	}
    if (confirm_password != password) {
        Swal.fire({
            title: 'Usuario',
            text: "Las contraseñas no coinciden",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.confirm_password.focus();
        return false;
    }
}

//VALIDAR VOCEROS
function  Voceros(obj) {
    var cedula = obj.cedula.value;
   if (!cedula) {
       Swal.fire({
           title: 'Voceros',
           text: "Debe de ingresar la cédula.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.cedula.focus();
       return false;
   }

   if (cedula.length < 7 || cedula.length > 8){
    Swal.fire({
        title: 'Voceros',
        text: "La cédula no puede tener más de 8 dígitos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })
    
    obj.cedula.focus();
    return (false);
    }


   var nombre = obj.nombre.value;
   if (!nombre) {
       Swal.fire({
           title: 'Voceros',
           text: "Debe de ingresar un nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.nombre.focus();
       return false;
   }

   if (nombre.length < 3){
       Swal.fire({
           title: 'Voceros',
           text: "Faltan dígitos en este campo de nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre.focus();
       return (false);
   }

   if (nombre.trim() == "") {
       Swal.fire({
           title: 'Voceros',
           text: "El Campo del nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre.focus();
       return false;
   }

   /* if (/(\w)\1+/i.test(nombre.toLowerCase())) {
    Swal.fire({
            title: 'Personas',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre.focus();
        return false;
    } */

   var apellido = obj.apellido.value;
   if (!apellido) {
       Swal.fire({
           title: 'Voceros',
           text: "Debe de ingresar el apellido.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
   
       obj.apellido.focus();
       return false;
   }


   if (apellido.length < 4){
       Swal.fire({
           title: 'Voceros',
           text: "Faltan dígitos en este campo de apellido.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       
       obj.apellido.focus();
       return (false);
   }


   if (apellido.trim() == "") {
       Swal.fire({
           title: 'Voceros',
           text: "El campo de apellido no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.apellido.focus();
       return false;
   }


  /*  if (/(\w)\1+/i.test(apellido.toLowerCase())) {
    Swal.fire({
            title: 'Voceros',
            text: "El campo del apellido no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.apellido.focus();
        return false;
    } */

    var fecha_nacimiento = obj.fecha_nacimiento.value;
   if (!fecha_nacimiento) {
       Swal.fire({
           title: 'Voceros',
           text: "Debe de ingresar fecha de nacimientos .",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.fecha_nacimiento.focus();
       return false;
   }
var fecha_nacimiento = obj.fecha_nacimiento.value;

// Validar que es mayor de edad
const hoy = new Date();
const fechaNac = new Date(fecha_nacimiento);
let edad = hoy.getFullYear() - fechaNac.getFullYear();
const mes = hoy.getMonth() - fechaNac.getMonth();

// Ajustar edad si aún no ha pasado el mes o día de nacimiento este año
if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
    edad--;
}

if (edad < 18) {
    Swal.fire({
        title: 'Voceros',
        text: "Debe ser mayor de 18 años para registrarse.",
        icon: 'error',
        confirmButtonColor: '#3085d6',
    });
    obj.fecha_nacimiento.focus();
    return false;
}



    var genero = obj.genero.value;
   if (!genero) {
       Swal.fire({
           title: 'Voceros',
           text: "Seleccione el género.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.genero.focus();
       return false;
    }

    var telefono = obj.telefono.value;
    if (!telefono) {
       Swal.fire({
           title: 'Voceros',
           text: "Debe de ingresar el Telefono.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.telefono.focus();
       return false;
   }

    var correo = obj.correo.value;
   if (!correo) {
       Swal.fire({
           title: 'Voceros',
           text: "Ingrese el correo.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
    })
     obj.correo.focus();
        return false;
    }

    //  var cargo = obj.cargo.value;
    // if (!cargo) {
    //     Swal.fire({
    //         title: 'Voceros',
    //         text: "Debe ingresar el cargo.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.cargo.focus();
    //     return false;

    var direccion = obj.direccion.value;
    if (!direccion) {
        Swal.fire({
            title: 'Voceros',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (direccion.trim() == "") {
        Swal.fire({
            title: 'Voceros',
            text: "El campo de dirección no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (/(\w)\2+/i.test(direccion.toLowerCase())) {
    Swal.fire({
            title: 'Voceros',
            text: "El campo de dirección no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.direccion.focus();
        return false;
    }

    if (direccion.length < 5){
        Swal.fire({
            title: 'Voceros',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.direccion.focus();
        return (false);
    }



}

//VALIDAR COMUNIDAD
function Comunidad(obj) {
//     var cedula_jefe = obj.cedula_jefe.value;
//    if (!cedula_jefe) {
//        Swal.fire({
//            title: 'Comunidad',
//            text: "Debe de ingresar la cédula.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.cedula_jefe.focus();
//        return false;
//    }

//    if (cedula_jefe.length < 7 || cedula_jefe.length > 8){
//     Swal.fire({
//         title: 'Comunidad',
//         text: "La cédula no puede tener más de 8 dígitos.",
//         icon: 'warning',
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         }).then((result) => {
//     if (result.isConfirmed) {

//         this.submit();
//     }
//     })
    
//     obj.cedula_jefe.focus();
//     return (false);
//     }


//    var nom_jefe = obj.nom_jefe.value;
//    if (!nom_jefe) {
//        Swal.fire({
//            title: 'Comunidad',
//            text: "Debe de ingresar un nombre.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })

//        obj.nom_jefe.focus();
//        return false;
//    }
//    if (nom_jefe.length < 3){
//        Swal.fire({
//            title: 'Comunidad',
//            text: "Faltan dígitos en este campo de nombre.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.nom_jefe.focus();
//        return (false);
//    }
//    if (nom_jefe.trim() == "") {
//        Swal.fire({
//            title: 'Comunidad',
//            text: "El Campo del nombre no debe contener espacios en blancos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.nom_jefe.focus();
//        return false;
//    }

//    /* if (/(\w)\1+/i.test(nom_jefe.toLowerCase())) {
//     Swal.fire({
//             title: 'Comunidad',
//             text: "El campo del nombre no debe contener caracteres repetidos.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.nom_jefe.focus();
//         return false;
//     } */

//    var ape_jefe = obj.ape_jefe.value;
//    if (!ape_jefe) {
//        Swal.fire({
//            title: 'Comunidad',
//            text: "Debe de ingresar el apellido.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
   
//        obj.ape_jefe.focus();
//        return false;
//    }
//    if (ape_jefe.length < 4){
//        Swal.fire({
//            title: 'Comunidad',
//            text: "Faltan dígitos en este campo de apellido.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })

       
//        obj.ape_jefe.focus();
//        return (false);
//    }
//    if (ape_jefe.trim() == "") {
//        Swal.fire({
//            title: 'Comunidad',
//            text: "El campo de apellido no debe contener espacios en blancos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.ape_jefe.focus();
//        return false;
//    }


//    /* if (/(\w)\1+/i.test(ape_jefe.toLowerCase())) {
//     Swal.fire({
//             title: 'Comunidad',
//             text: "El campo del apellido no debe contener caracteres repetidos.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.ape_jefe.focus();
//         return false;
//     } */


//     var telefono = obj.telefono.value;
//    if (!telefono) {
//        Swal.fire({
//            title: 'Comunidad',
//            text: "Debe de ingresar el Telefono.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.telefono.focus();
//        return false;
//    }

   var nom_comuni = obj.nom_comuni.value;
   if (!nom_comuni) {
       Swal.fire({
           title: 'Comunidad',
           text: "Debe de ingresar el nombre de la Comunidad.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nom_comuni.focus();
       return false;
   }

    var direccion = obj.direccion.value;
    if (!direccion) {
        Swal.fire({
            title: 'Comunidad',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (direccion.trim() == "") {
        Swal.fire({
            title: 'Comunidad',
            text: "El campo de dirección no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (/(\w)\2+/i.test(direccion.toLowerCase())) {
    Swal.fire({
            title: 'Comunidad',
            text: "El campo de dirección no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.direccion.focus();
        return false;
    }

    if (direccion.length < 5){
        Swal.fire({
            title: 'Comunidad',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.direccion.focus();
        return (false);
    }

}

//VALIDAR CONSEJO COMUNAL
function  ConsejoComunal(obj) {
//     var cedula_voce = obj.cedula_voce.value;
//    if (!cedula_voce) {
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "Debe de ingresar la cédula.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.cedula_voce.focus();
//        return false;
//    }

//    if (cedula_voce.length < 7 || cedula_voce.length > 8){
//     Swal.fire({
//         title: 'Consejo comunal',
//         text: "La cédula no puede tener más de 8 dígitos.",
//         icon: 'warning',
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         }).then((result) => {
//     if (result.isConfirmed) {

//         this.submit();
//     }
//     })
    
//     obj.cedula_voce.focus();
//     return (false);
//     }


//    var nom_voce = obj.nom_voce.value;
//    if (!nom_voce) {
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "Debe de ingresar un nombre.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })

//        obj.nom_voce.focus();
//        return false;
//    }
//    if (nom_voce.length < 3){
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "Faltan dígitos en este campo de nombre.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.nom_voce.focus();
//        return (false);
//    }
//    if (nom_voce.trim() == "") {
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "El Campo del nombre no debe contener espacios en blancos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.nom_voce.focus();
//        return false;
//    }

//   /*  if (/(\w)\1+/i.test(nom_voce.toLowerCase())) {
//     Swal.fire({
//             title: 'Consejo comunal',
//             text: "El campo del nombre no debe contener caracteres repetidos.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.nom_voce.focus();
//         return false;
//     } */

//    var ape_voce = obj.ape_voce.value;
//    if (!ape_voce) {
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "Debe de ingresar el apellido.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
   
//        obj.ape_voce.focus();
//        return false;
//    }
//    if (ape_voce.length < 4){
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "Faltan dígitos en este campo de apellido.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })

       
//        obj.ape_voce.focus();
//        return (false);
//    }
//    /* if (ape_voce.trim() == "") {
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "El campo de apellido no debe contener espacios en blancos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.ape_voce.focus();
//        return false;
//    } */


//    if (/(\w)\1+/i.test(ape_voce.toLowerCase())) {
//     Swal.fire({
//             title: 'Consejo comunal',
//             text: "El campo del apellido no debe contener caracteres repetidos.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.ape_voce.focus();
//         return false;
//     }


//     var telefono = obj.telefono.value;
//    if (!telefono) {
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "Debe de ingresar el Telefono.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.telefono.focus();
//        return false;
//    }

   var nom_consej = obj.nom_consej.value;
   if (!nom_consej) {
       Swal.fire({
           title: 'Consejo comunal',
           text: "Debe de ingresar el nombre del consejo comunal.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nom_consej.focus();
       return false;
   }

//    var codigo_situr = obj.codigo_situr.value;
//    if (!codigo_situr) {
//        Swal.fire({
//            title: 'Consejo comunal',
//            text: "Ingrese el código SITUR.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.codigo_situr.focus();
//        return false;
//    }

    var rif = obj.rif.value;
    // Expresión regular que verifica que comience con una letra mayúscula seguida por 9 números y puede contener guiones
    var regex = /^[A-Z]-?\d{9,10}$/;

    if (!rif) {
        Swal.fire({
            title: 'Consejo comunal',
            text: "Debe de ingresar el RIF.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
        
        obj.rif.focus();
        return false;
    } else if (!regex.test(rif)) {
        Swal.fire({
            title: 'Consejo comunal',
            text: "El RIF debe comenzar con una letra mayúscula, seguido por números .",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        });

        obj.rif.focus();
        return false;
    }


    if (rif.trim() == "") {
        Swal.fire({
            title: 'Consejo comunal',
            text: "El Campo del RIF de la empresa no debe contener espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.rif.focus();
        return false;
    }


    var dire_consejo = obj.dire_consejo.value;
    if (!dire_consejo) {
        Swal.fire({
            title: 'Consejo comunal',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.dire_consejo.focus();
        return false;
    }

    if (dire_consejo.trim() == "") {
        Swal.fire({
            title: 'Consejo comunal',
            text: "El campo de dirección no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.dire_consejo.focus();
        return false;
    }

    if (/(\w)\2+/i.test(dire_consejo.toLowerCase())) {
    Swal.fire({
            title: 'Consejo comunal',
            text: "El campo de dirección no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.dire_consejo.focus();
        return false;
    }

    if (dire_consejo.length < 5){
        Swal.fire({
            title: 'Consejo comunal',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.dire_consejo.focus();
        return (false);
    }

   var id_comunidad = obj.id_comunidad.value;
    if (!id_comunidad){
        Swal.fire({
            title: 'Consejo comunal',
            text: "Debe de seleccionar una comunidad asignado",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_comunidad.focus();
        return (false);
    }

    
}

//VALIDAR COMUNA
function Comuna(obj) {
//     var cedula_comunas = obj.cedula_comunas.value;
//    if (!cedula_comunas) {
//        Swal.fire({
//            title: 'Comuna',
//            text: "Debe de ingresar la cédula.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.cedula_comunas.focus();
//        return false;
//    }

//    if (cedula_comunas.length < 7 || cedula_comunas.length > 8){
//     Swal.fire({
//         title: 'Comuna',
//         text: "La cédula no puede tener más de 8 dígitos.",
//         icon: 'warning',
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         }).then((result) => {
//     if (result.isConfirmed) {

//         this.submit();
//     }
//     })
    
//     obj.cedula_comunas.focus();
//     return (false);
//     }


//    var nombre_comunas = obj.nombre_comunas.value;
//    if (!nombre_comunas) {
//        Swal.fire({
//            title: 'Comuna',
//            text: "Debe de ingresar un nombre.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })

//        obj.nombre_comunas.focus();
//        return false;
//    }
//    if (nombre_comunas.length < 3){
//        Swal.fire({
//            title: 'Comuna',
//            text: "Faltan dígitos en este campo de nombre.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.nombre_comunas.focus();
//        return (false);
//    }
//    if (nombre_comunas.trim() == "") {
//        Swal.fire({
//            title: 'Comuna',
//            text: "El Campo del nombre no debe contener espacios en blancos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.nombre_comunas.focus();
//        return false;
//    }

//   /*  if (/(\w)\1+/i.test(nombre_comunas.toLowerCase())) {
//     Swal.fire({
//             title: 'Comuna',
//             text: "El campo del nombre no debe contener caracteres repetidos.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.nombre_comunas.focus();
//         return false;
//     } */

//    var apellido_comunas = obj.apellido_comunas.value;
//    if (!apellido_comunas) {
//        Swal.fire({
//            title: 'Comuna',
//            text: "Debe de ingresar el apellido.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
   
//        obj.apellido_comunas.focus();
//        return false;
//    }
//    if (apellido_comunas.length < 4){
//        Swal.fire({
//            title: 'Comuna',
//            text: "Faltan dígitos en este campo de apellido.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })

       
//        obj.apellido_comunas.focus();
//        return (false);
//    }
//    if (apellido_comunas.trim() == "") {
//        Swal.fire({
//            title: 'Comuna',
//            text: "El campo de apellido no debe contener espacios en blancos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.apellido_comunas.focus();
//        return false;
//    }


//    /* if (/(\w)\1+/i.test(apellido_comunas.toLowerCase())) {
//     Swal.fire({
//             title: 'Comuna',
//             text: "El campo del apellido no debe contener caracteres repetidos.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.apellido_comunas.focus();
//         return false;
//     } */


//     var telefono = obj.telefono.value;
//    if (!telefono) {
//        Swal.fire({
//            title: 'Comuna',
//            text: "Debe de ingresar el Telefono.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.telefono.focus();
//        return false;
//    }

 var id_vocero = obj.id_vocero.value;
    if (!id_vocero){
        Swal.fire({
            title: 'Comuna',
            text: "Debe de seleccionar un vocero",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_vocero.focus();
        return (false);
    }

   var nom_comunas = obj.nom_comunas.value;
   if (!nom_comunas) {
       Swal.fire({
           title: 'Comuna',
           text: "Debe de ingresar el nombre de la comuna.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nom_comunas.focus();
       return false;
   }
   var id_parroquia = obj.id_parroquia.value;
    if (!id_parroquia){
        Swal.fire({
            title: 'Comuna',
            text: "Debe de seleccionar una Parroquia",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_parroquia.focus();
        return (false);
    }

     var id_consejo = obj.id_consejo.value;
    if (!id_consejo){
        Swal.fire({
            title: 'Comuna',
            text: "Debe de seleccionar un vocero",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_consejo.focus();
        return (false);
    }

    var dire_comunas = obj.dire_comunas.value;
    if (!dire_comunas) {
        Swal.fire({
            title: 'Comuna',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.dire_comunas.focus();
        return false;
    }

    if (dire_comunas.trim() == "") {
        Swal.fire({
            title: 'Comuna',
            text: "El campo de dirección no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.dire_comunas.focus();
        return false;
    }

    if (/(\w)\2+/i.test(dire_comunas.toLowerCase())) {
    Swal.fire({
            title: 'Comuna',
            text: "El campo de dirección no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.dire_comunas.focus();
        return false;
    }

    if (dire_comunas.length < 5){
        Swal.fire({
            title: 'Comuna',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.dire_comunas.focus();
        return (false);
    }

 
}


// Validar Proyecto
function Proyecto (obj) {
    var id_persona = obj.id_persona.value;
    if (id_persona==0){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar una persona.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var id_comunidad = obj.id_comunidad.value;
    if (!id_comunidad){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar una comunidad.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var nombre_pro = obj.nombre_pro.value;
    if (!nombre_pro) {
        Swal.fire({
            title: 'Proyecto',
            text: "Debe ingresar el nombre del proyecto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nombre_pro.focus();
        return false;
    }

    if (nombre_pro.trim() == "") {
        Swal.fire({
            title: 'Proyecto',
            text: "El campo nombre del proyecto no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nombre_pro.focus();
        return false;
    }

    if (nombre_pro.length < 5){
        Swal.fire({
            title: 'Proyecto',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nombre_pro.focus();
        return (false);
    }

    var descripcion_pro = obj.descripcion_pro.value;
    if (!descripcion_pro) {
        Swal.fire({
            title: 'Proyecto',
            text: "Debe ingresar la descripcion.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.descripcion_pro.focus();
        return false;
    }

    if (descripcion_pro.trim() == "") {
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "El campo de la Descripcion no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.descripcion_pro.focus();
        return false;
    }

    if (descripcion_pro.length < 5){
        Swal.fire({
            title: 'Proyecto',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.descripcion_pro.focus();
        return (false);
    }

    var latitud = obj.latitud.value;
    if (!latitud) {
        Swal.fire({
            title: 'Proyecto',
            text: "Ingrese la Latitud de proyecto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.latitud.focus();
        return false;
    }

    if (latitud.trim() == "") {
        Swal.fire({
            title: 'Proyecto',
            text: "El campo de la Descripcion no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.latitud.focus();
        return false;
    }

    if (latitud.length < 5){
        Swal.fire({
            title: 'Proyecto',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.latitud.focus();
        return (false);
    }

    var longitud = obj.longitud.value;
    if (!longitud) {
        Swal.fire({
            title: 'Proyecto',
            text: "Ingrese la Longitud de proyecto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.longitud.focus();
        return false;
    }

    if (longitud.trim() == "") {
        Swal.fire({
            title: 'Proyecto',
            text: "El campo de la  no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.longitud.focus();
        return false;
    }

    if (longitud.length < 5){
        Swal.fire({
            title: 'Proyecto',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.longitud.focus();
        return (false);
    }

    var direccion = obj.direccion.value;
    if (!direccion) {
        Swal.fire({
            title: 'Proyecto',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (direccion.trim() == "") {
        Swal.fire({
            title: 'Proyecto',
            text: "El campo de direccion no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (/(\w)\2+/i.test(direccion.toLowerCase())) {
    Swal.fire({
            title: 'Proyecto',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.direccion.focus();
        return false;
    }

    if (direccion.length < 5){
        Swal.fire({
            title: 'Proyecto',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.direccion.focus();
        return (false);
    }
    
    var fecha_inicial = obj.fecha_inicial.value;
    if (!fecha_inicial){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar una fecha inicial.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var fecha_evalu = obj.fecha_evalu.value;
    if (!fecha_evalu){
        Swal.fire({
            title: 'Evaluacion',
            text: "la fecha de evaluacion no puede ser muy vieja.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

}


// Validar Evaluacion
function Evaluacion (obj) {
    var id_proyecto = obj.id_proyecto.value;
    if (id_proyecto){
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe seleccionar un proyecto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    // var id_comunidad = obj.id_comunidad.value;
    // if (!id_comunidad){
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Debe seleccionar una comunidad.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     return (false);
    // }

    // var nombre_pro = obj.nombre_pro.value;
    // if (!nombre_pro) {
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Debe ingresar el nombre del proyecto.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.nombre_pro.focus();
    //     return false;
    // }

    // if (nombre_pro.trim() == "") {
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "El campo nombre del proyecto no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.nombre_pro.focus();
    //     return false;
    // }

    // if (nombre_pro.length < 5){
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Faltan dígitos en este campo de texto.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
       
    //     obj.nombre_pro.focus();
    //     return (false);
    // }

    var observaciones = obj.observaciones.value;
    if (!observaciones) {
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe ingresar una observacion.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.observaciones.focus();
        return false;
    }

    if (observaciones.trim() == "") {
        Swal.fire({
            title: 'Evaluacion',
            text: "El campo de la observacion no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.observaciones.focus();
        return false;
    }

    if (observaciones.length < 5){
        Swal.fire({
            title: 'Evaluacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.observaciones.focus();
        return (false);
    }

    // var latitud = obj.latitud.value;
    // if (!latitud) {
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Ingrese la Latitud de proyecto.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.latitud.focus();
    //     return false;
    // }

    // if (latitud.trim() == "") {
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "El campo de la Descripcion no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.latitud.focus();
    //     return false;
    // }

    // if (latitud.length < 5){
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Faltan dígitos en este campo de texto.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
       
    //     obj.latitud.focus();
    //     return (false);
    // }

    // var longitud = obj.longitud.value;
    // if (!longitud) {
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Ingrese la Longitud de proyecto.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.longitud.focus();
    //     return false;
    // }

    // if (longitud.trim() == "") {
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "El campo de la  no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.longitud.focus();
    //     return false;
    // }

    // if (longitud.length < 5){
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Faltan dígitos en este campo de texto.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
       
    //     obj.longitud.focus();
    //     return (false);
    // }

    // var direccion = obj.direccion.value;
    // if (!direccion) {
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Debe ingresar la dirección.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.direccion.focus();
    //     return false;
    // }

    // if (direccion.trim() == "") {
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "El campo de direccion no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.direccion.focus();
    //     return false;
    // }

    // if (/(\w)\2+/i.test(direccion.toLowerCase())) {
    // Swal.fire({
    //         title: 'Proyecto',
    //         text: "El campo nombre no debe contener caracteres repetidos.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     obj.direccion.focus();
    //     return false;
    // }

    // if (direccion.length < 5){
    //     Swal.fire({
    //         title: 'Proyecto',
    //         text: "Faltan dígitos en este campo de texto.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
       
    //     obj.direccion.focus();
    //     return (false);
    // }
    
    var fecha_evalu = obj.fecha_evalu.value;
    if (!fecha_evalu){
        Swal.fire({
            title: 'Evaluacion',
            text: "Debe seleccionar una fecha de evaluacion.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var fecha_final = obj.fecha_final.value;
    if (!fecha_final){
        Swal.fire({
            title: 'Proyecto',
            text: "Debe seleccionar una fecha final.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

}

// Validar PLANIFICACIÓN 
function Planificacion (obj) {
    var descri_alcance = obj.descri_alcance.value;
    if (!descri_alcance) {
        Swal.fire({
            title: 'Planificacion',
            text: "Debe ingresar la descripcion del alcance.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.descri_alcance.focus();
        return false;
    }

    if (descri_alcance.trim() == "") {
        Swal.fire({
            title: 'Planificacion',
            text: "El campo descripcion del alcance no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.descri_alcance.focus();
        return false;
    }

    if (/(\w)\2+/i.test(descri_alcance.toLowerCase())) {
    Swal.fire({
            title: 'Planificacion',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.descri_alcance.focus();
        return false;
    }

    if (descri_alcance.length < 5){
        Swal.fire({
            title: 'Planificacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.descri_alcance.focus();
        return (false);
    }

    var presupuesto = obj.presupuesto.value;
    if (!presupuesto) {
        Swal.fire({
            title: 'Planificacion',
            text: "Debe ingresar la descripcion del alcance.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.presupuesto.focus();
        return false;
    }

    if (presupuesto.trim() == "") {
        Swal.fire({
            title: 'Planificacion',
            text: "El campo descripcion del alcance no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.presupuesto.focus();
        return false;
    }

    if (/(\w)\2+/i.test(presupuesto.toLowerCase())) {
    Swal.fire({
            title: 'Planificacion',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.presupuesto.focus();
        return false;
    }

    if (presupuesto.length < 5){
        Swal.fire({
            title: 'Planificacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.presupuesto.focus();
        return (false);
    }
    
    var descri_obra = obj.descri_obra.value;
    if (!descri_obra) {
        Swal.fire({
            title: 'Planificacion',
            text: "Debe ingresar la descripcion de la obra.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.descri_obra.focus();
        return false;
    }

    if (descri_obra.trim() == "") {
        Swal.fire({
            title: 'Planificacion',
            text: "El campo descripcion de la obra no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.descri_obra.focus();
        return false;
    }

    if (/(\w)\2+/i.test(descri_obra.toLowerCase())) {
    Swal.fire({
            title: 'Planificacion',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.descri_obra.focus();
        return false;
    }

    if (descri_obra.length < 5){
        Swal.fire({
            title: 'Planificacion',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.descri_obra.focus();
        return (false);
    }

    var impacto_ambiental = document.querySelector('input[name="impacto_ambiental"]:checked');
    if (!impacto_ambiental) {
        Swal.fire({
            title: 'Planificacion',
            text: "Debe seleccionar si existe Impacto Ambiental (SI/NO).",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                // Enfocar el primer radio button (opcional)
                document.querySelector('input[name="impacto_ambiental"]').focus();
            }
        });

        return false; // Detener el envío del formulario
    }
    
    var impacto_social = document.querySelector('input[name="impacto_social"]:checked');
    if (!impacto_social) {
        Swal.fire({
            title: 'Planificacion',
            text: "Debe seleccionar si existe Impacto Social (SI/NO).",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                // Enfocar el primer radio button (opcional)
                document.querySelector('input[name="impacto_social"]').focus();
            }
        });

        return false; // Detener el envío del formulario
    }

    var fecha_inicio = obj.fecha_inicio.value;
    if (!fecha_inicio){
        Swal.fire({
            title: 'Planificacion',
            text: "Debe seleccionar una fecha_inicio.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var duracion_estimada = obj.duracion_estimada.value;
    if (!duracion_estimada){
        Swal.fire({
            title: 'Planificacion',
            text: "Debe seleccionar una duracion_estimada.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

}

// Validar SEGUIMIENTO
function Seguimiento (obj) {
    
 var responsable_segui = obj.responsable_segui.value;
   if (!responsable_segui) {
       Swal.fire({
           title: 'Seguimiento',
           text: "Ingrese el Nombre del Responsable.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.responsable_segui.focus();
       return false;
   }

   if (responsable_segui.length < 3){
       Swal.fire({
           title: 'Seguimiento',
           text: "Faltan dígitos en este campo de nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.responsable_segui.focus();
       return (false);
   }

   if (responsable_segui.trim() == "") {
       Swal.fire({
           title: 'Seguimiento',
           text: "El Campo del nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.responsable_segui.focus();
       return false;
   }

   if (/(\w)\1+/i.test(responsable_segui.toLowerCase())) {
    Swal.fire({
            title: 'Seguimiento',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.responsable_segui.focus();
        return false;
    }

    var detalle_segui = obj.detalle_segui.value;
    if (!detalle_segui) {
        Swal.fire({
            title: 'Seguimiento',
            text: "Ingrese los Detalles del Seguimiento.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.detalle_segui.focus();
        return false;
    }

    if (detalle_segui.trim() == "") {
        Swal.fire({
            title: 'Seguimiento',
            text: "El campo  Detalles de la obra no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.detalle_segui.focus();
        return false;
    }


    if (detalle_segui.length < 5){
        Swal.fire({
            title: 'Seguimiento',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.detalle_segui.focus();
        return (false);
    }
 var fecha_segui = obj.fecha_segui.value;
    if (!fecha_segui){
        Swal.fire({
            title: 'Seguimiento',
            text: "Debe seleccionar una fecha_inicio.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var estatus = obj.estatus.value;
    if (!estatus) {
       Swal.fire({
           title: 'Seguimiento',
           text: "Seleccione un Estatus.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.estatus.focus();
        return (false);
    }

      
}

// Fin de la validación del Sistema Minas //

//Validacion de no permitir numeros en los campos de texto de solo letras

function soloLetras(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite 
    if (tecla==8){
        return true;
    }
    if (tecla==0){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
patron =/[a-zA-ZÑñáéíóú .*/]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    
}


//Validacion de no permitir letras en los campos de texto de solo numeros
function solonum(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite 
    if (tecla==8){
        return true;
    }
    if (tecla==0){
    return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9/*.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

/*--------------Validacion de no permitir espacios en los campos de texto de usuario y clave del registro de Usuarios-----------------*/
function sinespacios(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite 
    if (tecla==8){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[a-zA-ZÑñáéíóú0-9/*._@#$%&()-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
