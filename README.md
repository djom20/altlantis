# Atlantis Framework
[![Build Status](https://travis-ci.org/slimphp/Slim.svg?branch=master)](https://travis-ci.org/slimphp/Slim)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/)

----------

¿Qué es REST?
-------------------
REST, REpresentational State Transfer, es un tipo de arquitectura de desarrollo web que se apoya totalmente en el estándar HTTP.

REST nos permite crear servicios y aplicaciones que pueden ser usadas por cualquier dispositivo o cliente que entienda HTTP, por lo que es increíblemente más simple y convencional que otras alternativas que se han usado en los últimos diez años como SOAP y XML-RPC.

REST se definió en el 2000 por Roy Fielding, coautor principal también de la especificación HTTP. Podríamos considerar REST como un framework para construir aplicaciones web respetando HTTP.

Por lo tanto REST es el tipo de arquitectura más natural y estándar para crear APIs para servicios orientados a Internet.

Existen tres niveles de calidad a la hora de aplicar REST en el desarrollo de una aplicación web y más concretamente una API que se recogen en un modelo llamado Richardson Maturity Model en honor al tipo que lo estableció, Leonard Richardson padre de la arquitectura orientada a recursos. Estos niveles son:

> - Uso correcto de URIs
> - Uso correcto de HTTP.
> - Implementar Hypermedia.

Además de estas tres reglas, nunca se debe guardar estado en el servidor, toda la información que se requiere para mostrar la información que se solicita debe estar en la consulta por parte del cliente.

Al no guardar estado, REST nos da mucho juego, ya que podemos escalar mejor sin tener que preocuparnos de temas como el almacenamiento de variables de sesión e incluso, podemos jugar con distintas tecnologías para servir determinadas partes o recursos de una misma API.


Framework
-------------

[Demo](http://test.altiviaot.com/atlantis/)

Características
-------------

* Potente enrutador
	* Métodos HTTP estándar y personalizados
	* Ruta de los parámetros con comodines y condiciones
	* Ruta redirigir, detener, y pase
	* Ruta middleware
* Localizador de recurso y el contenedor DI
* Renderizado de plantilla con vistas personalizadas
* Los mensajes flash
* Datos de cookies Encrypt
* Memoria caché HTTP
* Inicio de sesión con escritores registro personalizadas
* Manejo de errores y depuración
* Middleware y el gancho de la arquitectura
* Configuración sencilla

Como instalarlo
-------------

### Tutorial Hola Mundo

> **Muy pronto**


## Autor
Este producto de software fue creado por [Jonathan Olier](http://profile.altivaot.com) y fundador de [AltiviaOT](http://www.altivaot.com), desarrollador web Senior con mas de 5 años de experiencia
en el area web.


## Licencia
The Atlantis Framework is released under the MIT public license.
<https://github.com/altantis/blob/master/LICENSE>

> **Note:**
>
Actualmente esta es una versión Beta del producto que se esta construyendo como parte de un modelo de arquitectura de software para futuros proyectos web.
