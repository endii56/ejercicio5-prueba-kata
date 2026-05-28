# Kata: Mochila de aventura

## Descripción

Queremos construir una clase para gestionar una mochila de aventura mediante instrucciones de texto.

La mochila empieza vacía. El usuario puede guardar objetos, usar objetos o vaciar completamente la mochila.

Cada objeto tiene un nombre y una cantidad.

El objetivo de esta kata es practicar:

- Interpretación de comandos en texto.
- Gestión de cantidades.
- Uso de colecciones.
- Validaciones simples.
- Ordenación alfabética.
- TDD.
- Clean Code.

---

## Objetivo

Implementar una clase que mantenga el estado actual de la mochila.

Después de cada instrucción válida, el método debe devolver todos los objetos que hay en la mochila.

---

## Restricciones

- Solo debe existir una clase pública.
- La clase debe tener un único método público.
- El método público debe recibir un `String`.
- El método público debe devolver un `String`.
- La mochila empieza vacía.
- Los objetos no distinguen entre mayúsculas y minúsculas.
- Los objetos se guardan y se muestran en minúsculas.
- Los objetos deben aparecer ordenados alfabéticamente.
- No hace falta gestionar instrucciones mal formadas.

---

## Método público

```java
String ejecutar(String instruccion)
```

Ejemplo de uso:

```java
Mochila mochila = new Mochila();

mochila.ejecutar("guardar cuerda 2");
```

---

# Acciones disponibles

## 1. Guardar objeto

Permite añadir objetos a la mochila.

### Formato

```txt
guardar <objeto> [cantidad]
```

### Reglas

- Si no se indica cantidad, se asume `1`.
- Si el objeto no existe en la mochila, se añade.
- Si el objeto ya existe, se suma la cantidad.
- El nombre del objeto se guarda en minúsculas.
- Las cantidades serán siempre números enteros positivos.

### Ejemplo 1

```txt
Entrada:
guardar cuerda

Salida:
cuerda x1
```

### Ejemplo 2

```txt
Estado inicial:
cuerda x1

Entrada:
guardar antorcha 3

Salida:
antorcha x3, cuerda x1
```

### Ejemplo 3

```txt
Estado inicial:
antorcha x3, cuerda x1

Entrada:
guardar CUERDA 2

Salida:
antorcha x3, cuerda x3
```

---

## 2. Usar objeto

Permite usar una unidad de un objeto.

### Formato

```txt
usar <objeto>
```

### Reglas

- Si el objeto existe, se reduce su cantidad en `1`.
- Si después de usarlo la cantidad llega a `0`, el objeto desaparece de la mochila.
- Si el objeto no existe, se devuelve un mensaje de error.
- La búsqueda debe ignorar mayúsculas y minúsculas.

### Mensaje de error

Si el objeto no existe, se debe devolver exactamente:

```txt
El objeto seleccionado no existe
```

### Ejemplo 1

```txt
Estado inicial:
antorcha x3, cuerda x1

Entrada:
usar antorcha

Salida:
antorcha x2, cuerda x1
```

### Ejemplo 2

```txt
Estado inicial:
antorcha x1, cuerda x1

Entrada:
usar antorcha

Salida:
cuerda x1
```

### Ejemplo 3

```txt
Estado inicial:
cuerda x1

Entrada:
usar mapa

Salida:
El objeto seleccionado no existe
```

---

## 3. Vaciar mochila

Permite eliminar todos los objetos.

### Formato

```txt
vaciar
```

### Reglas

- Elimina todos los objetos de la mochila.
- Devuelve una cadena vacía.

### Ejemplo

```txt
Estado inicial:
antorcha x2, cuerda x1

Entrada:
vaciar

Salida:
""
```

---

## Formato de salida

Después de cada instrucción válida, se devuelve la mochila completa.

Cada objeto debe mostrarse con este formato:

```txt
<objeto> x<cantidad>
```

Los objetos deben aparecer:

- En minúsculas.
- Ordenados alfabéticamente.
- Separados por coma y espacio.

### Ejemplo

```txt
antorcha x2, cuerda x1, mapa x1
```

Si la mochila está vacía, se devuelve:

```txt
""
```

---

## Ejemplo de flujo completo

```txt
"guardar cuerda"      -> "cuerda x1"
"guardar antorcha 3"  -> "antorcha x3, cuerda x1"
"guardar CUERDA 2"    -> "antorcha x3, cuerda x3"
"usar antorcha"       -> "antorcha x2, cuerda x3"
"usar cuerda"         -> "antorcha x2, cuerda x2"
"usar mapa"           -> "El objeto seleccionado no existe"
"vaciar"              -> ""
```

---

## Casos de prueba recomendados

Puedes desarrollar la kata con TDD siguiendo este orden:

1. Guardar un objeto sin cantidad.
2. Guardar un objeto con cantidad.
3. Guardar dos objetos y mostrarlos ordenados.
4. Guardar el mismo objeto dos veces y sumar cantidades.
5. Guardar el mismo objeto con mayúsculas distintas.
6. Usar un objeto y reducir su cantidad.
7. Usar un objeto cuya cantidad llega a cero y eliminarlo.
8. Intentar usar un objeto inexistente.
9. Comprobar que un error no modifica la mochila.
10. Vaciar la mochila.
11. Después de vaciar, permitir guardar objetos de nuevo.

---

## Consejos de implementación

Puedes usar una estructura tipo mapa:

```txt
objeto -> cantidad
```

Por ejemplo:

```txt
cuerda -> 3
antorcha -> 2
```

Una posible estructura interna sería:

```java
ejecutar(instruccion)
guardarObjeto(nombre, cantidad)
usarObjeto(nombre)
vaciarMochila()
formatearMochila()
normalizarNombre(nombre)
```

Cuidado con el parseo de instrucciones:

```txt
guardar cuerda
guardar cuerda 2
usar cuerda
vaciar
```

No todas las instrucciones tienen el mismo número de partes.

---

## Sugerencia de commits

```txt
[rojo] - Crea test para guardar un objeto sin cantidad
[verde] - Guarda un objeto con cantidad uno
[rojo] - Crea test para guardar un objeto con cantidad
[verde] - Guarda objetos con cantidad indicada
[rojo] - Crea test para sumar cantidades de objetos repetidos
[verde] - Suma cantidades al guardar objetos existentes
[rojo] - Crea test para usar un objeto
[verde] - Reduce la cantidad al usar un objeto
[rojo] - Crea test para eliminar objeto al llegar a cero
[verde] - Elimina objetos sin cantidad
[rojo] - Crea test para usar objeto inexistente
[verde] - Devuelve error si el objeto no existe
[refactor] - Extrae parseo y formateo de mochila
```