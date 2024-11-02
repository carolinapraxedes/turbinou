# Configuração

1. Execute o Docker com o seguinte comando:
   ```bash
   docker compose build

2. Copie o arquivo .env.example e crie o arquivo .env

3. Com o arquivo .env criado, configure as variáveis de ambiente do banco de dados:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=turbinou
DB_USERNAME=turbinou
DB_PASSWORD=turbinou
```

4.Agora, entre no bash do container do Laravel e execute o comando:
```
php artisan migrate --seed 
```

5.No seu terminal, inicie os containers com o seguinte comando:
``` 
docker compose up
```