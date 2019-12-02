# Gana
Proyecto final de PHP (4to trimestre)

Pagina con el fin de evaluar temas de php como
  - Manejo de AJAX
  - Sentencias a la base de datos
  - Login Manejando Variables de $_SESSION.
  - Manejo de archivos en texto plano usando Fopen
  - Uso de Toastr para generar alertas
  - Uso de procedimientos almacenados y vistas
  - Consumo de API (Recaptcha)
  
  Login con sus respectivas validaciones
  ![Imagen del login](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/Login.png)
  
  Una vez validado el login lo llevara a esta vista, en la cual se cargan todos los empleados registrados en la taquilla a la     que accedio
  ![Imagen del selectPerfil](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/Select%20Perfil.png)
  
  Vista general usando diseño de dashboard y AJAX para cargar contenido
  ![Imagen del home](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/Home.png)
  
# Funcionalidad Hacer Envio 

## Parte 1
  Esta es la vista general, el input cuenta con **busqueda en tiempo real** al detectar que hay mas de **6 caracteres**
  ![Imagen de hacerEnvio Parte 1](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/HacerEnvio-1.png)
  
  En caso de **no existir** el sistema mostrara su respectivo error.
  ![Imagen de hacerEnvio Error 1](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/HacerEnvio-Error1.png)
  
## Parte 2
  Si el usuario existe, proseguira habilitando el campo de **DNI RECEPTOR** 
  ![Imagen de hacerEnvio Parte 2](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/HacerEnvio-2.png)
  
  En caso de **no existir** el sistema mostrara su respectivo error.
  ![Imagen de hacerEnvio Error 2](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/HacerEnvio-Error2.png)
  
## Parte 3
  Una vez presionado "ENVIAR GIRO" el sistema abrira otra pestaña con el ticket en formato txt(Alli el empleado usara `CTRL + P`   para imprimirlo) y la pestaña anterior se redireccionara al Home.
  ![Imagen de TicketGiro](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/TicketGiro.png) 
  
# Funcionalidad Buscar Envio   

## Basico
  Una vez ingresado el **DNI RECEPTOR** el sistema cargara todos los giros que se **pueden reclamar en esa taquilla**.
  ![Imagen de buscarEnvio](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/BuscarEnvio-1.png)
  
## Detalles  
  En caso de **Existir** envios para el usuario, pero **no se puedan reclamar en esa taquilla** se mostrara el siguiente aviso. 
  ![Imagen de hacerEnvio Alerta 1](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/BuscarEnvio-Alert1.png)
  
  En caso de **No existir** envios para el usuario se mostrara el siguiente aviso. 
  ![Imagen de hacerEnvio Alerta 2](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/BuscarEnvio-Alert2.png)
  
  
# Funcionalidad Añadir Usuario
  Añade con sus respectivas validaciones
  ![Imagen del añadirUsuario](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/AddUsuario.png)
  En caso de existir el sistema mostrara el siguiente error
  ![Imagen del añadirUsuario](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/AddUsuario-Error.png)
  
 # Funcionalidad En Construcción (Diseño)
 Tiene funcionalidad y el Recaptcha v2 esta vinculado con mi cuenta de Google, se usa 2 Api Key (Lado Server, Lado Cliente).
 [Para mas información](https://developers.google.com/recaptcha/intro).
 ![Imagen del consultar](https://github.com/Amonbe8080/Gana/blob/master/Screenshots/ConsultarEnvio.png)
 
# Notas Rapidas
 - El proyecto usa como Framework de Diseño [Material Design for Bootstrap](https://mdbootstrap.com/).
 - Cuenta con arquitectura en 2 capas **Vista / Controlador**.
 - Al **guardar los tiquetes** tiene el siguiente orden
    - Tiquetes :file_folder:
      - Entregas :file_folder:
      - Giros :file_folder:
 


  
