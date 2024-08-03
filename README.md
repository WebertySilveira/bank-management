## **Requisitos**

> > [PHP ^8.1](https://www.php.net/downloads)
> 
> > [Composer](https://getcomposer.org/)
>
> > [Plataforma de api - Postman|Insomia...](https://www.postman.com/)

## **Iniciando o projeto**
Execute o comando para instalar as dependências da aplicação
```
composer install
```
Faça uma cópia de .env.example para .env

Execute o comando para configurar o banco de dados
```
php artisan migrate
```

Gere a chave de acesso executando o comando:
```
php artisan key:generate
```

Iniciar a aplicação
```
php artisan serve
```

## **Acessando a aplicação**
Com a aplicação inicializa, você pode acessar as rotas através da sua plataforma de api

**Rota de criação de conta**
```
/api/conta
```
- Passar os dados via Json como no exemplo
```
{
    "numero_conta": 2324,
    "saldo": 10
}
```

**Rota de consulta de conta**
```
/api/conta?numero_conta=2324
```

**Rota de cadastro de transacao**
```
/api/transacao
```

- Passar os dados via Json como no exemplo
```
{
    "forma_pagamento":"D", 
    "numero_conta": 234, 
    "valor":1
}
```

