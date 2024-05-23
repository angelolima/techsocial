# TechSocial

Bem-vindo ao repositório do TechSocial. Este guia irá orientá-lo em como clonar o projeto e configurá-lo localmente usando Docker e Composer.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes programas instalados em sua máquina:

- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/)

## Clonando o Repositório

Para clonar o repositório, execute o seguinte comando em seu terminal:

```sh
git clone git@github.com:angelolima/techsocial.git 
```


## Configuração do Projeto
Passo 1: Subindo os Contêineres com Docker
Após clonar o repositório, navegue até o diretório do projeto e execute o seguinte comando para iniciar os contêineres Docker:

```sh
docker-compose up -d
```

## Passo 2: Instalando Dependências com Composer
Com os contêineres em execução, instale as dependências do projeto utilizando o Composer:

```sh
composer install
```

## Pronto!
Agora seu ambiente deve estar configurado e pronto para uso. Se você tiver qualquer dúvida ou encontrar problemas, sinta-se à vontade para abrir uma issue no repositório.

## Licença
Este projeto está licenciado sob a licença MIT. 
Veja o arquivo LICENSE para mais detalhes.

### Obrigado por contribuir com o TechSocial!
