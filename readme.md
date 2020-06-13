# Desafio SC

- Inicie os containers
```
docker-compose up --build -d
```

- Entre no container php

```
docker exec -it php sh
```

- Crie as tabelas
```
php artisan migrate
```

- Acesse o link
```
http://127.0.0.1:81
```