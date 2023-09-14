# Funcion get_permalink()
La función get_permalink() utiliza la tabla wp_posts en la base de datos de WordPress para obtener la información necesaria para construir el permalink. La tabla wp_posts almacena todos los tipos de contenido en WordPress, como publicaciones, páginas y tipos de contenido personalizado. Cada fila en esta tabla representa un objeto individual y contiene información como el título, el contenido y la fecha de publicación.

+ Al llamar a la función get_permalink(), se consulta la tabla **wp_posts** utilizando el **ID** o el objeto del contenido especificado y se recupera la información necesaria para construir el permalink. Luego, la función devuelve la URL completa del permalink correspondiente al objeto solicitado.

### Tabla wp_learnpress_user_items
Especificamente en la columna 'status', esta la logica del manejo de los cursos.
Contiene las horas que tomo pasar el examen
+ en la columna 'graduation', estan los valores (passed, in-progress, null)
