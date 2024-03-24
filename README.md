# File-Upload-Labs

3 Laboratórios vulneráveis a File Upload, separados em Low, Medium e Hard.<br />
A primeira é uma página completamente vulnerável.<br />
O segundo tem uma falha de nível médio com uma White List de arquivos.<br />
O terceiro tem uma Black List de execução de arquivo php e MIME Type verificado.<br />

# Como configurar o Docker?
## Instalação do Docker
`sudo apt install docker.io docker-compose`

OBS: em caso de falta de dependência de arquivos, execute:
`sudo apt install -f`

## Documentação docker-compose.yaml
O docker-compose possuí a configuração de um servidor LAMP(Linux, Apache, Mysql e PHP), nele temos os seguintes serviços:

**1. web**
-`web:`<br />
-`build:`<br />
-`context: .`<br />
-`dockerfile: Dockerfile`<br />
-`ports:`<br />
-`      - "80:80"`<br />
-`volumes:`<br />
-`      - ./site:/var/www/html`<br />
-`networks:`<br />
-`- app-network`<br />

O serviço **web** constroi a imagem web pela chamada do arquivo Dockerfile inserida no `context: .` referênciado pelo diretório local.<br />
Seguindo do `ports: 80:80` sendo ela a referência da página web do localhost, junto com a montagem do volume site com o diretório /var/www/html.

**2. mysql**
  -`mysql:`<br />
    -`image: mysql:8.0`<br />
    -`environment:`<br />
    -`  MYSQL_ROOT_PASSWORD: P@ssw0rd!123`<br />
    -`  MYSQL_DATABASE: mysql`<br />
    -`  MYSQL_USER: kali`<br />
    -`  MYSQL_PASSWORD: k@l!`<br />
    -`ports:`<br />
    -` - "3306:3306"`<br />
    -`volumes:`<br />
    -`  - ./data:/var/lib/mysql`<br />
    -`networks:`<br />
    -`  - app-network`<br />
  
O serviço **mysql** executa a imagem na versão 8.0 do banco de dados.<br />
O enviroment é uma variavel que constroi o ambiente do banco de dados informando senha, database, usuário e senha de usuário, pré definidos na instalação.<br />
Configurando a porta de banco 3306 do localhost, juntamente configurando o ambiente do diretório /var/lib/mysql no volume `data`.<br />

  **3. networks**
  `networks:`<br />
  `  app-network:`<br />
  `    driver: bridge`<br />
  
O serviço **networks** configura as interfaces de rede em modo bridge criando redes virtuais para cada serviço no docker, elas são referênciadas na interface de rede local.<br />

## Incialização do Docker
1. Crie uma pasta no diretório onde sera configurada o docker<br />
2. Insira os arquivos docker-compose.yaml e Dockerfile na pasta criada<br />
3. Bash execute o comando `docker-compose up -d` no diretório do docker<br />

**Replique o conteúdo do arquivo site do repositório no arquivo criado pelo docker**

Pronto o docker está configurado, acesse no navegador:<br />
`http://localhost/`


