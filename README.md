# Docker-LEMP
## Si al hacer docker-compose up y acceder a la ip del servidor, nos aparece Connection failed: SQLSTATE[HY000] [2002] Connection refused. Debemos parar el servidor, y ir a la carpeta nginx y modificar el fichero nginx.conf. En server_name volver a escribir el mismo valor, guardar y volver a hacer docker-compose up. De momento es la única solución, hasta que resuelva dicho fallo.
