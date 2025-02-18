
# CRUD Completo

Hola **Juan**, te dejo por aquí el ejercicio que me solicitaste. Disculpa el tiempo, pero empecé algo tarde y tuve problemas de compatibilidad con algunas librerías (Uso **MAC**, jaja).

Es de lo más básico, pero cumple con lo que solicitaste.

## Instrucciones

Si quieres correr el programa, es necesario que sigas los siguientes pasos:

### 1. Necesitas **XAMPP** o **WAMPP**
Asegúrate de tener instalado uno de estos.

### 2. Ingresar a tu carpeta raíz de **htdocs** dentro de la carpeta de XAMPP
La carpeta **htdocs** es donde debes colocar el proyecto para que XAMPP pueda ejecutarlo.

### 3. Clonar este repositorio dentro de la carpeta **htdocs**
Puedes usar el siguiente comando para clonar el repositorio:

```bash
git clone (la url)
```

### 4. Iniciar los servicios
Abre el panel de control e inicia los servicios.

### 5. Ir a **phpMyAdmin** y correr el script para la creación de la base de datos y los datos
Entra a phpMyAdmin y ejecuta el script que te dejo en txt de la base de datos para crear las tablas necesarias.

A este paso ya deberia de funcionar pero si no, haz el paso 6.

### 6. Correr los siguientes comandos dentro de la carpeta del proyecto

Si **no tienes Composer**:

```bash
curl -sS https://getcomposer.org/installer | php
move composer.phar C:\ProgramData\ComposerSetupin\composer
composer require phpoffice/phpspreadsheet
```

Si ya tienes **Composer** instalado:

```bash
composer require phpoffice/phpspreadsheet
```

Saludos.
