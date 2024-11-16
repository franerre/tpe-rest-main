
# API FUTBOL ⚽

## INTEGRANTES
Errezarret Franco(franerre15@gmail.com), Fernandez Marcos(Marcosfernant2@gmail.com).

## DESCRIPCION
Trabajo especial 3ra entrega, se trata sobre una api de futbol donde podemos obtener jugadores y/o equipos, donde tambien
se puede editar, eliminar, crear entre algunas opciones.

### OBTENER TODOS LOS EQUIPOS

```http
  GET /tpe-rest-main/api/equipos
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
  GET /tpe-rest-main/api/jugadores
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
  GET /tpe-rest-main/api/equipos/3
```
#### ejemplo:

```json
[
{
    "id": 3,
    "equipo": "Napoli",
    "liga": "Serie A",
    "pais": "Italia"
}
    ]
```

### OBTENER JUGADOR POR ID

```http
  GET /tpe-rest-main/api/jugadores/3
```
#### ejemplo:

```json
[
{
    "id": 3,
    "nombre": "Ferran ",
    "apellido": "Torres",
    "id_equipo": 9
}
    ]
```

### CREAR UN NUEVO EQUIPO

```http
  POST /tpe-rest-main/api/equipos/
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
  POST /tpe-rest-main/api/jugadores/
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
  DELETE /tpe-rest-main/api/equipos/3
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
  DELETE /tpe-rest-main/api/jugadores/3
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
  PUT /tpe-rest-main/api/equipos/3
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
  PUT /tpe-rest-main/api/jugadores/3
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
  GET /tpe-rest-main/api/equipos/3/equipo (si queres saber la liga reemplaza equipo por "liga" lo mismo para pais, "pais" )
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
  GET /tpe-rest-main/api/jugadores/2/nombre (si queres saber el apellido reemplaza nombre por "apellido" lo mismo para id_equipo, "id_equipo")
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
  GET /tpe-rest-main/api/equipos?sort=id&order=ASC (ASCENDENTE).
  GET /tpe-rest-main/api/equipos?sort=id&order=DESC (DESCENDENTE).
  Si queres que se muestre ordenado por otro campo, solo cambia id por equipo, liga o pais.
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
  GET /tpe-rest-main/api/jugadores?sort=id&order=ASC (ASCENDENTE).
  GET /tpe-rest-main/api/jugadores?sort=id&order=DESC (DESCENDENTE).
  Si queres que se muestre ordenado por otro campo, solo cambia id por nombre, apellido o id_equipo.
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