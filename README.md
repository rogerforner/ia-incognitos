<!-- TOC -->autoauto- [Incògnitos](#incògnitos)auto    - [Descargar](#descargar)auto    - [Tema padre](#tema-padre)auto    - [Plugins](#plugins)auto        - [ACF Pro](#acf-pro)auto            - [Útil](#útil)auto- [Requisitos](#requisitos)auto- [Mostrar datos](#mostrar-datos)auto    - [Textos legales (shortcodes)](#textos-legales-shortcodes)auto        - [Aviso legal](#aviso-legal)auto        - [RGPD: Reglamento General de Protección de Datos](#rgpd-reglamento-general-de-protección-de-datos)auto        - [Política de Cookies](#política-de-cookies)auto    - [Horario Laboral](#horario-laboral)auto- [Roles y Permisos](#roles-y-permisos)auto    - [Permisos (capabilities)](#permisos-capabilities)autoauto<!-- /TOC -->

# Incògnitos

Incògnitos es un _tema hijo_ de WordPress.org con el que se pretende ampliar las funcionalidades de Divi, el _tema padre_, sin la necesidad de tocar la estructura principal de éste.

> Incògnitos se distribuye bajo los términos de la licencia MIT, ésta compatible con la GNU GPL.

_Ah sí! Incògnitos es el nombre de mi compañero felino._ :P

## Descargar

```
$ git clone https://github.com/rogerforner/IlercApp-Incognitos.git incognitos
```

## Tema padre

Incògnitos és un tema hijo de **Divi**, un tema de WordPress.org, Copyright (C) [Elegant Themes, Inc.](https://www.elegantthemes.com).

> _Divi_ se distribuye bajo los términos de la GNU GPL.

## Plugins

### ACF Pro

Incògnitos incorpora código de **Advanced Custom Fields Pro**, un plugin de WordPress.org, Copyright (C) [Elliot Condon](https://www.advancedcustomfields.com/pro).

> _Advanced Custom Fields Pro_ se distribuye bajo los términos de la GNU GPL.

#### Útil

Integra ACF Pro directamente en el tema, inserta el directorio del plugin dentro de _incognitos/plugins/acf/_. Con ello debería funcionarte todo de forma correcta dado que, si te fijas en el _.gitignore_, verás que así trabajamos nosotros :)

# Requisitos

Es necesario disponer de:

**Tema**

- Divi

**Plugins**

- ACF Pro

# Mostrar datos

## Textos legales (shortcodes)

### Aviso legal

- **Condiciones generales**: ``[legal_condicionesGenerales]``
- **Ley aplicable y jurisdicción**: ``[legal_leyAplicable]``
- **Exclusión de garantías y responsabilidad**: ``[legal_responsabilidad]``
- **Contenido responsable**: ``[legal_contenidoResponsable]``
- **Links o hiperenlaces**: ``[legal_linksHiperenlaces]``
- **Restricciones del uso del dominio y subdominios**: ``[legal_dominioSubdominios]``
- **Propiedad intelectual e industrial**: ``[legal_propiedadIntelectual]``

### RGPD: Reglamento General de Protección de Datos

- **Información básica**: ``[legal_rgpdInfoBasica]``
- **Responsable**: ``[legal_rgpdResponsable]``
- **Finalidad**: ``[legal_rgpdFinalidad]``
- **Legitimación**: ``[legal_rgpdLegitimacion]``
- **Destinatarios**: ``[legal_rgpdDestinatarios]``
- **Derechos**: ``[legal_rgpdDerechos]``
- **Procedencia**: ``[legal_linksProcedencia]``

### Política de Cookies

- **Información**: ``[legal_cookiesInfo]``
- **Cookies**: ``[legal_cookiesUtilizadas]``

## Horario Laboral

- **Horario (tabla)**: ``[info_horarioGeneral]``

# Roles y Permisos

## Permisos (capabilities)

El/La usuario/ria administrador/ra dispone de las siguientes capacidades una vez activado el tema.

- ``manage_acf``: Necesario para interactuar con ACF Pro.
- ``manage_acf_legal``: Necesario para interactuar con los textos legales y el aviso de cookies.
- ``manage_acf_info``: Necesario para insertar el horario laboral y las redes sociales.
- ``manage_acf_login``: Necesario para interactuar con la personalización de la pagina de login.
