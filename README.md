<!-- TOC -->

- [Incògnitos](#inc%C3%B2gnitos)
    - [Tema padre](#tema-padre)
    - [Plugins](#plugins)
        - [ACF Pro](#acf-pro)
            - [Útil](#%C3%BAtil)
- [Requisitos](#requisitos)
- [Mostrar datos](#mostrar-datos)
    - [Textos legales (shortcodes)](#textos-legales-shortcodes)
        - [Aviso legal](#aviso-legal)
        - [RGPD: Reglamento General de Protección de Datos](#rgpd-reglamento-general-de-protecci%C3%B3n-de-datos)
        - [Política de Cookies](#pol%C3%ADtica-de-cookies)
    - [Horario Laboral](#horario-laboral)
- [Roles y Permisos](#roles-y-permisos)
    - [Permisos (capabilities)](#permisos-capabilities)

<!-- /TOC -->

# Incògnitos

Incògnitos es un _tema hijo_ de WordPress.org con el que se pretende ampliar las funcionalidades de Divi, el _tema padre_, sin la necesidad de tocar la estructura principal de éste.

> Incògnitos se distribuye bajo los términos de la licencia MIT, ésta compatible con la GNU GPL.

_Ah sí! Incògnitos es el nombre de mi compañero felino._ :P

## Tema padre

Incògnitos és un tema hijo de **Divi**, un tema de WordPress.org, Copyright (C) [Elegant Themes, Inc.](https://www.elegantthemes.com).

> _Divi_ se distribuye bajo los términos de la GNU GPL.

## Plugins

### ACF Pro

Incògnitos incorpora código de **Advanced Custom Fields Pro**, un plugin de WordPress.org, Copyright (C) [Elliot Condon](https://www.advancedcustomfields.com/pro).

> _Advanced Custom Fields Pro_ se distribuye bajo los términos de la GNU GPL.

#### Útil

Si se desea integrar ACF Pro directamente en el tema, inserta el directorio del plugin dentro de _incognitos/plugins/acf/_. Con ello debería funcionarte todo de forma correcta dado que, si te fijas en el _.gitignore_, verás que así trabajamos nosotros :)

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

- **Condiciones generales**: ``[info_horarioGeneral]``

# Roles y Permisos

## Permisos (capabilities)

- ``manage_acf``: Necesario para interactuar con ACF Pro.
- ``manage_acf_legal``: Necesario para interactuar con los textos legales y el aviso de cookies.
