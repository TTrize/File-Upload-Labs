# File-Upload-Labs

3 Laboratórios vulneraveis a File Upload, separados em Low, Medium e Hard.
a primeira é uma página completamente vulnerável
o segundo tem uma falha de nível médio com uma White List de arquivos
o terceiro tem uma Black List de execução de arquivo php e MIME Type verificado.

# How configure Docker
## Instalação do Docker
`sudo apt install docker.io docker-compose`

OBS: em caso de falta de depencia de arquivos execute:
`sudo apt install -f`

## Documentação docker-compose.yaml
O docker-compose possuí a configuração de um servidor LAMP(Linux, Apache, Mysql e PHP), nele temos os seguintes serviços:

**1. web**
-`web:`
-`build:`
-`context: .`
-`dockerfile: Dockerfile`
-`ports:`
-`      - "80:80"`
-`volumes:`
-`      - ./site:/var/www/html`
-`networks:`
-`- app-network`

O serviço **web** constroi a imagem web pela chamada do arquivo Dockerfile inserida no `context: .` referênciado pelo diretório local.
Seguindo do `ports: 80:80` sendo ela a referência da página web do localhost, junto com a montagem do volume site com o diretório /var/www/html.

**2. mysql**
  -`mysql:`
    -`image: mysql:8.0`
    -`environment:`
    -`  MYSQL_ROOT_PASSWORD: P@ssw0rd!123`
    -`  MYSQL_DATABASE: mysql`
    -`  MYSQL_USER: kali`
    -`  MYSQL_PASSWORD: k@l!`
    -`ports:`
    -` - "3306:3306"`
    -`volumes:`
    -`  - ./data:/var/lib/mysql`
    -`networks:`
    -`  - app-network`
  
O serviço **mysql** executa a imagem na versão 8.0 do banco de dados.
O enviroment é uma variavel que constroi o ambiente do banco de dados informando senha, database, usuário e senha de usuário, pré definidos na instalação.
Configurando a porta de banco 3306 do localhost, juntamente configurando o ambiente do diretório /var/lib/mysql no volume `data`

  **3. networks**
  `networks:`
  `  app-network:`
  `    driver: bridge`
  
O serviço **networks** configura as interfaces de rede em modo bridge criando redes virtuais para cada serviço no docker, elas são referênciadas na interface de rede local.

## Incialização do Docker
1. Crie uma pasta no diretório onde sera configurada o docker
2. Insira os arquivos docker-compose.yaml e Dockerfile na pasta criada
3. Bash execute o comando `docker-compose up -d` no diretório do docker

**Replique o conteúdo do arquivo site do repositório no arquivo criado pelo docker**

Pronto o docker está configurado, acesse no navegador:
`http://localhost/`


