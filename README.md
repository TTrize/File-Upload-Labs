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

O serviço **web** constroi a imagem web(Ubuntu) pela chamada do arquivo Dockerfile inserida no `context: .` referênciado pelo diretório local.<br />
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

## Configuração do apache2.conf
1.No terminal execute o comando `docker ps` e copie o valor do container ID<br />
2.Execute o comando `docker exec -it "id do container" bash`<br />
3.Dentro do container edite o arquivo apache2.conf `vim /etc/apache2/apache2.conf`<br />
4.Adicione abaixo do campo FilesMatch, o regex de config do php para o lab.<br />
`<FilesMatch "\.(php\.jpeg|php\.jpg|php\.png|php\.gif)$"><br />
    SetHandler application/x-httpd-php<br />
</FilesMatch>`<br />
5.Salve o arquivo e restarte o apache `service apache2 restart`<br />
6.No seu terminal execute o comando `docker-compose up -d`<br />

Pronto o docker está configurado, acesse no navegador:<br />
`http://localhost/`

## PLUS
**Configurar hostname da maquina local**
No diretório do docker já configurado execute `docker ps`<br />
Nele irá aparecer os id's de container do docker, acesse o container web executando `docker exec -it id-do-container bash`<br />
Dentro do container execute `cat /etc/hosts` na ultima linha haverá o ip de referência da bridge do container<br />
No seu sistema execute `sudo nano /etc/hosts` e insira o ip do container e uma url de referência (Exemplo:172.24.0.4   fantasy-blog.local)<br />
Salve o arquivo e acesse a url `http://fantasy-blog.local`<br />
Lembrete: Quando reiniciado o docker o ip de referência é alterado.<br />

## Imagens do laboratório

**Home**
![home](https://github.com/TTrize/File-Upload-Labs/assets/113475439/bace321d-9872-4022-abf0-da60db7ff41f)

**Vulnerable**
![low](https://github.com/TTrize/File-Upload-Labs/assets/113475439/252a8b0e-2528-455f-8cf5-14374d7c1631)

**Medium**
![medium](https://github.com/TTrize/File-Upload-Labs/assets/113475439/11880547-54fc-4d0a-bcfb-a4f10050fea2)

**Hard(Safe)**
![hard](https://github.com/TTrize/File-Upload-Labs/assets/113475439/84c708a0-065d-4cac-86a3-28b712b2170e)
