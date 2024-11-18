
# API FUTBOL ⚽

## INTEGRANTES
Errezarret Franco(franerre15@gmail.com), Fernandez Marcos(Marcosfernant2@gmail.com).

## DESCRIPCION
Trabajo especial 3ra entrega, se trata sobre una api de futbol donde podemos obtener jugadores y/o equipos, donde tambien
se puede editar, eliminar, crear entre algunas opciones.

### OBTENER TODOS LOS EQUIPOS

```http
  GET localhost/tpe-rest-main/api/equipos
```
#### ejemplo:

```json
[
    {
        "id": 0,
        "equipo": "Manchester City",
        "liga": "Premier League",
        "pais": "Inglaterra",
        "imagen": "city.png"
    },
    {
        "id": 1,
        "equipo": "Real Madrid",
        "liga": "La Liga",
        "pais": "España",
        "imagen": "real.png"
    },
    {
        "id": 2,
        "equipo": "Inter de Milán",
        "liga": "Serie A",
        "pais": "Italia",
        "imagen": "inter.png"
    }
    
]
```

### OBTENER TODO LOS JUGADORES

```http
  GET localhost/tpe-rest-main/api/jugadores
```
#### ejemplo:

```json
[
{
        "id": 2,
        "nombre": "Kevin",
        "apellido": "De Bruyne",
        "id_equipo": 0,
        "imagen_jugador": "De Bruyne.png"
    },
    {
        "id": 3,
        "nombre": "Earling",
        "apellido": "Haaland",
        "id_equipo": 0,
        "imagen_jugador": "Haaland.png"
    },
    {
        "id": 4,
        "nombre": "Robert ",
        "apellido": "Lewandowski",
        "id_equipo": 9,
        "imagen_jugador": "Lewandowski.png"
    },
    {
        "id": 5,
        "nombre": "Ferran ",
        "apellido": "Torres",
        "id_equipo": 9,
        "imagen_jugador": "Torres.png"
    },
    {
        "id": 6,
        "nombre": "Ronald ",
        "apellido": "Araujo",
        "id_equipo": 9,
        "imagen_jugador": "araujo.png"
    },  
    ]
```
### OBTENER EQUIPO POR ID

```http
  GET localhost/tpe-rest-main/api/equipos/3
```
#### ejemplo:

```json
[
{
    "id": 3,
    "equipo": "Napoli",
    "liga": "Serie A",
    "pais": "Italia",
    "imagen": "napolii.png"
}
    ]
```

### OBTENER JUGADOR POR ID

```http
  GET localhost/tpe-rest-main/api/jugadores/3
```
#### ejemplo:

```json
[
{
    "id": 3,
    "nombre": "Earling",
    "apellido": "Haaland",
    "id_equipo": 0,
    "imagen_jugador": "Haaland.png"
}]
```

### CREAR UN NUEVO EQUIPO

```http
  POST localhost/tpe-rest-main/api/equipos/
```
#### ejemplo:

```json
[
{
      (la ID No es necesario modificar ya que se incrementa sola) ⚠️
        "equipo": "Nombre...",
        "liga": "Liga...",
        "pais": "Pais..",
        "imagen": "imagen.png/jpg"
}
    ]
```
### CREAR UN NUEVO JUGADOR

```http
  POST localhost/tpe-rest-main/api/jugadores/
```
#### ejemplo:

```json
[
{
      (la ID No es necesario modificar ya que se incrementa sola) ⚠️
        "nombre": "Nombre..",
        "apellido": "Apellido..",
        "id_equipo": "id del equipo..",
        "imagen_jugador": "imagen.png/jpg"
}
    ]
```
### ELIMINAR UN EQUIPO 

```http
  DELETE localhost/tpe-rest-main/api/equipos/3
```
#### ejemplo:

```json
[
{
      "El equipo con id=3 ha sido borrado."
}
    ]
```
### ELIMINAR UN JUGADOR 

```http
  DELETE localhost/tpe-rest-main/api/jugadores/3
```
#### ejemplo:

```json
[
{
      "El jugador con id=3 ha sido borrado."
}
    ]
```
### MODIFICAR UN EQUIPO

```http
  PUT localhost/tpe-rest-main/api/equipos/3
```
#### ejemplo:

```json
[
  {
        "id": 3,
        "equipo": "Nombre..",
        "liga": "Liga..",
        "pais": "Pais...",
        "imagen": "imagen.png/jpg"
  }
    ]
```
Se modifica y se guarda en la base de datos

### MODIFICAR UN JUGADOR

```http
  PUT localhost/tpe-rest-main/api/jugadores/3
```
#### ejemplo:

```json
[{
        "id": 3,
        "nombre": "Nombre..",
        "apellido": "Apellido..",
        "id_equipo": "ID del equipo..",
        "imagen_jugador": "imagen.png/jpg" 
} 
    ]
```
Se modifica y se guarda en la base de datos

### OBTENER NOMBRE DE UN EQUIPO

```http
  GET localhost/tpe-rest-main/api/equipos/3/equipo 
  (si queres saber la liga, pais o imagen reemplaza equipo por "liga", "pais", o "imagen")
```
#### ejemplo:

```json
[
{
    "Napoli"
}
]
```


### OBTENER NOMBRE DE UN JUGADOR

```http
  GET localhost/tpe-rest-main/api/jugadores/2/nombre 
  (si queres saber el apellido, id_equipo o la imagen del jugador remplaza nombre por "apellido", "id_equipo", o "imagen_jugador")
```
#### ejemplo:

```json
[
{
    "Robert"
}
]

```
### ORDENAR EQUIPOS DE FORMAR ASCENDENTE O DESCENDENTE

```http
  GET localhost/tpe-rest-main/api/equipos?sort=id&order=ASC (ASCENDENTE).
  GET localhost/tpe-rest-main/api/equipos?sort=id&order=DESC (DESCENDENTE).
  Si queres que se muestre ordenado por otro campo, solo cambia id por equipo, liga, pais o imagen.
```
  #### ejemplo:

```json
ASCENDENTE:
[
 {
        "id": 0,
        "equipo": "Manchester City",
        "liga": "Premier League",
        "pais": "Inglaterra",
        "imagen": "city.png"
    },
    {
        "id": 1,
        "equipo": "Real Madrid",
        "liga": "La Liga",
        "pais": "España",
        "imagen": "real.png"
    },
    {
        "id": 2,
        "equipo": "Inter de Milán ",
        "liga": "Serie A",
        "pais": "Italia",
        "imagen": "inter.png"
    },
    {
        "id": 3,
        "equipo": "Napoli",
        "liga": "Serie A",
        "pais": "Italia",
        "imagen": "napolii.png"
    },
    .
    .
    .
]

DESCENDENTE: 
[
    {
        "id": 10,
        "equipo": "Manchester United",
        "liga": "Premier League",
        "pais": "Inglaterra",
        "imagen": "united.png"
    },
    {
        "id": 9,
        "equipo": "Barcelona",
        "liga": "LaLiga",
        "pais": "España",
        "imagen": "barcelona.png"
    },
    {
        "id": 8,
        "equipo": "Juventus",
        "liga": "Serie A",
        "pais": "Italia",
        "imagen": "juventus.png"
    },
    {
        "id": 7,
        "equipo": "Liverpool",
        "liga": "Premier League",
        "pais": "Inglaterra",
        "imagen": "liverpol.png"
    }
    .
    .
    .
    ]

```
### ORDENAR JUGADORES DE FORMAR ASCENDENTE O DESCENDENTE

```http
  GET localhost/tpe-rest-main/api/jugadores?sort=id&order=ASC (ASCENDENTE).
  GET localhost/tpe-rest-main/api/jugadores?sort=id&order=DESC (DESCENDENTE).
  Si queres que se muestre ordenado por otro campo, solo cambia id por nombre, apellido, id_equipo o imagen_jugador.
```
  #### ejemplo:

```json
ASCENDENTE:
[
    {
        "id": 1,
        "nombre": "Phil",
        "apellido": "Foden",
        "id_equipo": 0,
        "imagen_jugador": "foden.png"
    },
    {
        "id": 2,
        "nombre": "Kevin",
        "apellido": "De Bruyne",
        "id_equipo": 0,
        "imagen_jugador": "De Bruyne.png"
    },
    {
        "id": 3,
        "nombre": "Earling",
        "apellido": "Haaland",
        "id_equipo": 0,
        "imagen_jugador": "Haaland.png"
    },
    {
        "id": 4,
        "nombre": "Robert ",
        "apellido": "Lewandowski",
        "id_equipo": 9,
        "imagen_jugador": "Lewandowski.png"
    },
    .
    .
    .
] 

DESCENDENTE: 
[
{
        "id": 33,
        "nombre": "Alejandro ",
        "apellido": "Garnacho ",
        "id_equipo": 10,
        "imagen_jugador": "garnacho.png"
    },
    {
        "id": 32,
        "nombre": "Marcus ",
        "apellido": "Rashford",
        "id_equipo": 10,
        "imagen_jugador": "Marcus Rashford.png"
    },
    {
        "id": 31,
        "nombre": "Bruno ",
        "apellido": "Fernandes",
        "id_equipo": 10,
        "imagen_jugador": "fernandes.png"
    },
    {
        "id": 30,
        "nombre": "Manuel ",
        "apellido": "Locatelli",
        "id_equipo": 8,
        "imagen_jugador": "Manuel Locatelli.png"
    },
    .
    .
    .
]
```
### PAGINAR EQUIPOS
```http
  GET localhost/tpe-rest-main/api/equipos?offset=0&limit=5
  Si queres realizar pruebas solo modifica set=0, limit=5 por el rango que quieras. 
```
  #### ejemplo:

```json
 [
    {
        "id": 0,
        "equipo": "Manchester City",
        "liga": "Premier League",
        "pais": "Inglaterra",
        "imagen": "city.png"
    },
    {
        "id": 1,
        "equipo": "Real Madrid",
        "liga": "La Liga",
        "pais": "España",
        "imagen": "real.png"
    },
    {
        "id": 2,
        "equipo": "Inter de Milán ",
        "liga": "Serie A",
        "pais": "Italia",
        "imagen": "inter.png"
    },
    {
        "id": 3,
        "equipo": "Napoli",
        "liga": "Serie A",
        "pais": "Italia",
        "imagen": "napolii.png"
    },
    {
        "id": 4,
        "equipo": "Atletico Madrid",
        "liga": "La Liga",
        "pais": "España",
        "imagen": "atletico.png"
    }
]
```
### PAGINAR JUGADORES
```http
  GET localhost/tpe-rest-main/api/jugadores?offset=0&limit=5
  Si queres realizar pruebas solo modifica set=0, limit=5 por el rango que quieras. 
```
  #### ejemplo:

```json
[
    {
        "id": 1,
        "nombre": "Phil",
        "apellido": "Foden",
        "id_equipo": 0,
        "imagen_jugador": "foden.png"
    },
    {
        "id": 2,
        "nombre": "Kevin",
        "apellido": "De Bruyne",
        "id_equipo": 0,
        "imagen_jugador": "De Bruyne.png"
    },
    {
        "id": 3,
        "nombre": "Earling",
        "apellido": "Haaland",
        "id_equipo": 0,
        "imagen_jugador": "Haaland.png"
    },
    {
        "id": 4,
        "nombre": "Robert ",
        "apellido": "Lewandowski",
        "id_equipo": 9,
        "imagen_jugador": "Lewandowski.png"
    },
    {
        "id": 5,
        "nombre": "Ferran ",
        "apellido": "Torres",
        "id_equipo": 9,
        "imagen_jugador": "Torres.png"
    }
]
```
### FILTRAR COLECCION ENTERA MEDIANTE UN CAMPO DE EQUIPOS
```http

  GET localhost/tpe-rest-main/api/equipos?filter=liga&value=Premier League

  para realizar mas pruebas, cambiamos liga por pais y premier league por un pais ej(España, Inglaterra, etc)
```
  #### ejemplo:

```json
[
    {
        "id": 0,
        "equipo": "Manchester City",
        "liga": "Premier League",
        "pais": "Inglaterra",
        "imagen": "city.png"
    },
    {
        "id": 7,
        "equipo": "Liverpool",
        "liga": "Premier League",
        "pais": "Inglaterra",
        "imagen": "liverpol.png"
    },
    {
        "id": 10,
        "equipo": "Manchester United",
        "liga": "Premier League",
        "pais": "Inglaterra",
        "imagen": "united.png"
    }
]
```
### FILTRAR COLECCION ENTERA MEDIANTE UN CAMPO DE JUGADORES
```http

  GET localhost/tpe-rest-main/api/jugadores?filter=id_equipo&value=4

```
  #### ejemplo:

```json

   [
    {
        "id": 16,
        "nombre": "Julian",
        "apellido": "Alvarez",
        "id_equipo": 4,
        "imagen_jugador": "araña.png"
    },
    {
        "id": 17,
        "nombre": "Rodrigo ",
        "apellido": "De Paul",
        "id_equipo": 4,
        "imagen_jugador": "de paul.png"
    },
    {
        "id": 18,
        "nombre": "Antoine ",
        "apellido": "Griezmann",
        "id_equipo": 4,
        "imagen_jugador": "Griezmann.png"
    }
]