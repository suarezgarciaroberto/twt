# **The Worker Tree**

Este proyecto forma parte de una de las tareas del <a href="https://www.masterd.es/master-en-programacion-web-y-movil">máster en programación multiplataforma</a> de MasterD.

## **Tabla de contenidos**

- [**The Worker Tree**](#the-worker-tree)
  - [**Tabla de contenidos**](#tabla-de-contenidos)
  - [**Información general**](#información-general)
  - [**Objetivo de la tarea**](#objetivo-de-la-tarea)
  - [**Realización de los objetivos**](#realización-de-los-objetivos)
  - [**Demo**](#demo)
  - [**Capturas de pantalla**](#capturas-de-pantalla)
  - [**Tecnologías empleadas**](#tecnologías-empleadas)
  - [**Mejoras**](#mejoras)

## **Información general**

**Fecha**: Julio de 2021.<br/>
**Duración**: 3 meses.<br/>

Esta tarea es la continuación de otra en la que se pedía un sitio web que podía pertenecer a una empresa ficticia o a un portfolio de programador. Los requisitos de dicha tarea eran los siguientes:
* Una página de inicio con una sección de noticias que se cargaban de un archivo JSON.
* Una página de galería donde se mostraban los diferentes proyectos realizados en una galería dinámica.
* Una página de presupuesto en la que el usuario ingresaba los datos referentes al proyecto que deseaba encargar y finalmente se calculaba un presupuesto estimado.
* Una página de contacto que debía incluir un mapa con la posibilidad de mostrar la ruta desde la ubicación del usuario hacia el negocio.

Basándome en esto, realicé la tarea que se muestra en este repositorio cumpliendo con los objetivos que se describen en la siguiente sección.

## **Objetivo de la tarea**

* Una base de datos que contenga las siguientes tablas:
  * Usuarios
  * Clientes(*)
  * Noticias
  * Proyectos
  * Citas
* Una sección de administrador en la que se puedan modificar los datos referentes a los usuarios, proyectos, noticias y citas.
* Una sección de usuario (cliente) en la que se puedan modificar los datos personales y las citas.
* Los usuarios no administradores sólo pueden modificar las citas hasta 72h antes de la misma.
* Las contraseñas para acceder a la sección de usuario deben estar cifradas al menos en SHA256.
* Impedir que se pueda acceder a la sección de usuario si no se está logeado en el sitio web.

(*) La tabla de clientes se puede combinar con la de usuarios añadiendo un campo de rol.

## **Realización de los objetivos**

* Se decidió simplificar el diseño de la base de datos combinando las tablas de Usuarios y Clientes añadiendo el campo de rol.
* Se utilizó _PASSWORD_DEFAULT_ para el cifrado de las contraseñas ya que utiliza por defecto el algoritmo _bcrypt_. Además, el uso de _PASSWORD_DEFAULT_ resulta beneficioso ya que esta constante está diseñada para cambiar siempre que se añada un algoritmo nuevo y más fuerte a PHP. <a href="https://www.php.net/manual/es/function.password-hash.php">Fuente</a>.
* Se añadió la funcionalidad de que un usuario creado desde la sección administrativa tenga la contraseña _"password"_ por defecto.

## **Demo**

<a href="https://theworkertree.herokuapp.com/">The Worker Tree</a>

Los datos se restablecen con los valores por defecto cada vez que se reinicia el servidor.

## **Capturas de pantalla**

(To Do)

## **Tecnologías empleadas**

(añadir badges)
HTML5, CSS3, JavaScript, PHP, MySQL

## **Mejoras**

En el futuro me gustaría incluir las siguientes mejoras al proyecto:
* Incluir algún framework que permita tener un código más limpio y ordenado.
* Incluir la posibilidad de subir, editar y/o borrar las imágenes en el servidor.
* Automatizar el redireccionamiento a la página de cambiar contraseña si se detecta que la contraseña de un usuario coincide con _"password"_
* Realizar un proyecto nuevo basado en éste utilizando Java en el backend.
