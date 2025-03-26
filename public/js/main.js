document.addEventListener("DOMContentLoaded", function () {
    // Seleccionar el formulario de servicios
    const formularios = document.querySelectorAll(".formulario-estilizado");
    const botonRegresar = document.getElementById("btn-regresar");
    const alertas = document.querySelectorAll(".alerta");
    const botonesCancelar = document.querySelectorAll(".btn-cancelar");
    const noCancelable = document.querySelectorAll(".no-cancelable");
    const mensajeBienvenida = document.getElementById("mensaje-bienvenida");
    const togglePassword = document.getElementById('togglePassword');

    function togglePasswordVisibility() {
        var passwordField = document.getElementById('contrasenia');
        var eyeIcon = document.getElementById('togglePassword');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.textContent = '❌';  // Cambiar el ícono a ojo cerrado
        } else {
            passwordField.type = 'password';
            eyeIcon.textContent = '👁️';  // Cambiar el ícono a ojo abierto
        }
    }
    
    if (togglePassword) {
        togglePassword.onclick = togglePasswordVisibility;
    }

    botonesCancelar.forEach(boton => {
        boton.addEventListener("click", function (e) {
            if (!confirm("¿Está seguro de que desea cancelar este servicio?")) {
                e.preventDefault(); 
            }
        });
    });

    // Mensaje no cancelable cuando queda pocos días para que se cumpla el pedido
    noCancelable.forEach(mensaje => {
        mensaje.style.color = "#ff0000"; 
    });

    alertas.forEach(alerta => {
        const tipo = alerta.dataset.tipo;

        if (alerta.textContent.trim()) {
            alerta.style.display = "flex";

            // Ocultar después de 5 segundos
            setTimeout(() => {
                alerta.style.display = "none";
            }, 5000);
        }
    });

    // Botón de regreso para ir a la página previa a la que está
    if (botonRegresar) {
        botonRegresar.addEventListener("click", function () {
            botonRegresar.disabled = true; // Desactiva el botón
            botonRegresar.textContent = "Regresando..."; // Cambia el texto

            // Navega hacia la página anterior
            setTimeout(() => {
                window.history.back();
            }, 500);
        });
    }

    // Seleccionar y aplicar estilos a los formularios
    formularios.forEach(form => {
        form.style.maxWidth = "400px";
        form.style.margin = "50px auto";
        form.style.padding = "20px";
        form.style.backgroundColor = "#f9f9f9";
        form.style.border = "2px solid #013F4E";
        form.style.borderRadius = "15px";
        form.style.boxShadow = "0 8px 10px rgba(0, 0, 0, 0.2)";
    
        // Aplicar estilos a los botones dentro del formulario
        const botonesFormulario = form.querySelectorAll("button");
        botonesFormulario.forEach(boton => {
            boton.style.backgroundColor = "#0BA5BE";
            boton.style.color = "#fff";
            boton.style.padding = "10px 20px";
            boton.style.border = "none";
            boton.style.borderRadius = "5px";
            boton.style.cursor = "pointer";
            boton.style.transition = "background-color 0.3s ease";
    
            boton.addEventListener("mouseover", function () {
                boton.style.backgroundColor = "#00718F";
            });
            boton.addEventListener("mouseout", function () {
                boton.style.backgroundColor = "#0BA5BE";
            });
        });
    
        // Estilos específicos para campos de entrada dentro del formulario
        const inputs = form.querySelectorAll("input, textarea, select");
        inputs.forEach(input => {
            input.style.display = "block";
            input.style.width = "100%";
            input.style.marginBottom = "15px";
        });
    });

    if (typeof nombreUsuario !== "undefined" && nombreUsuario.trim() !== "") {
        const mensajeDiv = document.createElement("div");
        mensajeDiv.style.padding = "20px";
        mensajeDiv.style.backgroundColor = "#d4edda"; // Verde claro
        mensajeDiv.style.color = "#155724"; // Verde oscuro
        mensajeDiv.style.border = "1px solid #c3e6cb";
        mensajeDiv.style.borderRadius = "5px";
        mensajeDiv.style.textAlign = "center";
        mensajeDiv.style.margin = "20px";
        mensajeDiv.textContent = `¡Bienvenido, ${nombreUsuario}! Nos alegra verte aquí.`;
    
        mensajeBienvenida.appendChild(mensajeDiv);
    
        setTimeout(() => {
            mensajeDiv.style.display = "none";
        }, 5000);
    } else {
        console.warn("La variable nombreUsuario no está definida o está vacía.");
    }

    window.addEventListener("load", () => {
        document.body.style.backgroundSize = "cover";
        document.body.style.height = "100vh"; // Garantiza que siempre ocupe la pantalla completa
    }); 
});
