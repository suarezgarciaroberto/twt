create table `citas` (
  `id` int not null primary key auto_increment,
  `clientid` int not null,
  `client` text not null,
  `asunto` text not null,
  `fecha` date not null,
  `lugar` text not null,
  `hora` time not null
);

create table `noticias` (
  `id` int not null primary key auto_increment,
  `titular` text not null,
  `resumen` mediumtext not null,
  `contenido` longtext not null,
  `fecha` text not null
);

create table `proyectos` (
  `id` int not null primary key auto_increment,
  `titulo` text not null,
  `descripcion` longtext not null,
  `tecnologias` text not null,
  `tiempo` text not null
);

create table `usuarios` (
  `id` int not null primary key auto_increment,
  `nombre` text not null,
  `apellidos` text not null,
  `email` text not null,
  `password` text not null,
  `telefono` int not null,
  `role` text not null
);

INSERT INTO `usuarios` (`nombre`, `apellidos`, `email`, `password`, `telefono`, `role`) VALUES
('Administrador', 'admin admin', 'admin@admin.com', '$2y$10$SO2Ndmi4MDfy8IXXMVTleOCHNXKEqgq0CtLUNGsxxEta/hOT1aCwa', 123456789, 'admin'),
('Lola', 'Flores Campos', 'lola@user.com', '$2y$10$YGi9FDku/oJruy8YSRy/0ulOJj1R8XhnvY/J5wscUA04GFiC58rr6', 123456789, 'user');

INSERT INTO `proyectos` (`titulo`, `descripcion`, `tecnologias`, `tiempo`) VALUES
('FinPerApp', 'Aplicación para gestionar las finanzas personales de una manera adaptada a las necesidades de cada uno. Cuenta con numerosas opciones de personalización, además de sincronización con la nube.', 'android|css3|github|html5|apple|node|react', '2 meses'),
('EasyEventApp', 'Con esta aplicación podrás crear eventos y compartirlos con tus amigos de una manera rápida e intuitiva.', 'css3|html5|js|php|wordpress', '1 mes'),
('TuTiendaApp', 'Compra ropa de hombre, mujer o niño en TuTiendaApp, una tienda completamente renovada y actualizada, la misma ropa de siempre pero con un toque novedoso. ¡Nunca pasa de moda!', 'android|github|apple|node|react', '3 meses'),
('LibrarySystem', '¿Alguna vez has ido a una biblioteca y al acceder al archivo te has encontrado un Excel un poco lioso? Solucionado! Con este sistema de archivos podrás localizar los libros y documentos casi instantáneamente gracias a su potente buscador y su rápida e intuitiva manera de añadir nuevos registros.', 'css3|github|html5|js|php', '5 meses'),
('BuscaCafe', 'La app que te busca las cafeterías cercanas y las ordena según el precio del café. Tiene la posibilidad de guardar favoritos.', 'android|css3|html5|apple|js|python', '2 meses'),
('Harmonyzer', 'Esta app corrige tus ejercicios de armonía, directamente en el navegador o en tu dispositivo móvil.', 'android|css3|github|html5|apple|java|js', '10 meses');

INSERT INTO `noticias` (`titular`, `resumen`, `contenido`, `fecha`) VALUES
('Nueva oficina', 'Nos mudamos a un nuevo emplazamiento ubicado en Tenerife', 'Desde nuestra fundación como empresa no hemos parado de crecer. Al principio éramos un grupo de 4 personas que trabajaban en remoto, cada uno desde su casa. Hoy en día contamos con un grupo de más de 15 personas y ha sido necesaria la adquisición de una oficina para trabajar más cómodos y, sobre todo, para socializar entre nosotros!', '2019'),
('Implementamos React', 'React como front para agilizar nuestras aplicaciones de página única', 'Hemos decidido implementar React como tecnología para nuestros front-end dada su gran versatilidad a la hora de hacer aplicaciones de una sola página. Su estructura basada en componentes nos resulta sumamente llamativa y atractiva, a la par que muy versátil.', '2019'),
('Nuevo miembro', 'Contamos con un nuevo miembro en el equipo', 'Es nuestra mascota, se encarga de la vital tarea de mantener alta la moral y los ánimos por las nubes!!!', '2019'),
('FinPerApp', 'Anunciamos una nueva aplicación', 'FinPerApp es una aplicación pensada para aquellas personas que desean mayor control sobre sus finanzas personales, tiene muchísimas opciones de personalización e incluye sincronización en la nube. Hemos logrado desarrollar esta aplicación en tiempo récord, ¡apenas 2 meses!, gracias a nuestro gran equipo y, sobre todo, a nuestro director de proyecto y CEO, que ha sabido dirigir el desarrollo de una forma excelente.', '2020'),
('Inteligencia artificial', 'Nos adentramos en un mundo totalmente nuevo', 'Debido al auge de la inteligencia artificial en los últimos años, hemos decidido aprender a usarla en nuestros proyectos, aunque aún estamos a la espera de poder implementarla en alguno, consideramos que hemos trasteado lo suficiente como para estar preparados para lanzarnos a la aventura!', '2020'),
('Nuevo equipamiento', 'Nos complace anunciar nuestra renovación de equipos para desarrollo', 'Hemos decidido hacer una inversión en infraestructura debido a que cada miembro del equipo utilizaba su ordenador personal, con las diferencias de características que esto conlleva para el equipo en su conjunto. Hemos decidido adquirir un NAS para tener todos nuestros archivos centralizados y seguros, además de nuevos ordenadores sobremesa y portátiles, para que nuestros trabajadores se sientan libres de trabajar tanto en la oficina como en casa, o incluso en otro país!', '2021');

INSERT INTO `citas` (`clientid`,`client`, `asunto`, `fecha`, `lugar`, `hora`) values
(2,'Lola','Presentación del proyecto','2022-04-28','telematica','10:30:00');
