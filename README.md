# Sistema Administrativo de Buffets

## Descrição do projeto 
Um sistema administrativo que gerencia um sistema de buffets que pode ser [encontrado aqui](https://github.com/Projetos-Pucc/sistema-comercial).

## Funcionalidades
<ul>
    <li>Relatório de vendas</li>
    <li>Criação e organização de representantes comerciais</li>
    <li>Criação de pacotes comerciais para buffets</li>
    <li>Organização do sistema</li>
    <li>etc...</li>
</ul>

## Instalação do projeto: 

### Instalação do docker: 
*Instalar o docker no seu computador:*
```
https://www.docker.com/
```

### Instalação do NodeJS: 
*Instalar o NodeJS no seu computador:*
```
https://www.docker.com/
```

### Clonar repositório do Github
*Pelo site do github:*
```
https://github.com/Projetos-Pucc/sistema-administrativo.git
```
```sh
cd sistema-administrativo/
```


Crie o Arquivo .env
```sh
cp .env.example .env
```

Instalar as dependências PHP do projeto
```sh
composer install
```

Configure o sail
```sh
code ~/.bashrc
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
source ~/.bashrc
```

> O código acima cadastra um "apelido" no terminal para reduzir os comandos a serem executados no container do laravel


<br>

Suba os containers do projeto
```sh
sail up -d --build
```
ou caso não tenha aplicado o alias
```sh
./vendor/bin/sail up -d --build
```



Gerar a key do projeto Laravel
```sh
sail artisan key:generate
```

Executar as migrations
```sh
sail artisan migrate
```

Inicializar os valores base no banco de dados
```sh
sail artisan db:seed
```

Fora do terminal docker, executar
```sh
npm install
npm run dev
```

Caso as imagens iniciais não renderizem, tente dentro do docker: 
```sh
sail artisan storage:link
```

Acessar o projeto
[http://localhost:8080](http://localhost:8080)