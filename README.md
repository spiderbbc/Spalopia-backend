# Proyecto [Spalopia-backend](https://github.com/spiderbbc/Spalopia-backend) en Docker

Este repositorio contiene un proyecto Laravel configurado para ejecutarse en Docker. Sigue estas instrucciones para levantar el proyecto en tu entorno local.

## Requisitos

- Docker
- Docker Compose

## Instrucciones

1. Clona este repositorio en tu máquina local:

   ```bash
   git clone https://github.com/spiderbbc/Spalopia-backend

2. Construye los contenedores de Docker

   ```
   docker-compose build
   ```

3.  Levanta los contenedores:

   ```
   docker-compose up -d
   ```

4.  Instala las dependencias de PHP utilizando Composer:

   ```
   docker-compose exec app composer install
   ```

5.  Ejecuta las migraciones para crear las tablas en la base de datos:

   ```
   docker-compose exec app php artisan migrate
   ```

6.  Poblar la base de datos con datos de ejemplo, ejecuta los seeders:

   ```
   docker-compose exec app php artisan db:seed
   ```



#### API (REST) 

 1. **Listado de servicios:**

    ```
    GET http://localhost:8080/api/servicios
    # en otro idiomas disponibles
    GET http://localhost:8080/api/servicios/eng
    GET http://localhost:8080/api/servicios/pt
    GET http://localhost:8080/api/servicios/it
    GET http://localhost:8080/api/servicios/fr
    ```

 2. **Listado de las horas disponibles de un servicio en una fecha concreta:**

    ```
    GET http://localhost:8080/api/horas-disponibles/<service_id>/<fecha>
    ej: http://localhost:8080/api/horas-disponibles/1/2024-01-01
    ```

 3. **Creación de una reserva:**

    ```
    POST http://localhost:8080/api/reservas
    ```

    3.1 cuerpo tipo json a enviar

    ```json
    {
        "nombre_cliente": "Cliente de prueba",
        "email_cliente": "cliente@example.com",
        "dia_servicio": "2024-01-01",
        "hora_servicio": "10:00:00",
    	"servicio_id":1,
    	"precio_reserva": "50.00"
     }
    ```

    

para todas las rutas mencionadas configurar lo siguiente en el apartados **headers** de su **Postman o Insomia**

```
Content-Type: application/json
Accept: application/json
```





### Ejecutar Test

```
docker-compose exec app php artisan test
```



####  Implementar un registro de los cambios que sufre la entidad “Servicio”

Se propone crear una entidad **ReviewsSystem** la cual sera una representación de una tabla en nuestra base de datos con las siguientes propiedades:

- id 
- servicio_id: id o clave foránea de la entidad a registrar el cambio
- user_id: id del usuario quien realizo el cambio
- action: el evento que se realizo
- valor_anterior: registro anterior si existe
- valor_nuevo: nuevo registro
- create_at: fecha de creación de la revisión



**Implementar un observador de modelo**: Crea un observador de modelo para la entidad "Servicio" que escuche los eventos relevantes, como **`created`, `updated` y `deleted`.** 

**Registrar los cambios pertinentes**: Cuando se cree, actualice o elimine un servicio, el observador de modelo debería registrar los cambios relevantes en la tabla de registro de cambios. Por ejemplo, si se actualiza un servicio y se modifica el campo de "precio", se debe registrar en la tabla de registro de cambios el cambio del precio con el valor anterior y el nuevo valor.

**Consultar el registro de cambios**: podríamos listar los cambios de un servicio y visualizar todos los cambios sufridos en el servicio.











## Built With



- [Laravel](https://laravel.com/) - The PHP Framework for Web Artisans

## Gratefulness



- Spalopia

## Author



- **Eduardo Morales** - *Initial work* - [repository](https://github.com/spiderbbc/Spalopia-backend)
