-------------- IMPORTANTE -----------------

Por favor, prestar atenção no charset da aplicação.

De preferência que seja UTF-8.

Sequencia para aplicação funcionar:

1 - Executar script dentro da pasta "banco/, banco de dados MySQL";

2 - Pelo terminal, acessar a pasta "/lib" e executar o comando "composer install"

3 - Emule a aplicação caso não tenha o WAMPP ou XAMPP pelo terminal utilizando o comando:

    3.1 - php -S localhost:8080

4 - Acesse com as credenciais:

- E-mail: admin@admin.com
- Senha: 123456
- E-mail: empresa@empresa.com
- Senha: 123456
- E-mail: consultor@consultor.com
- Senha: 123456

5 - Caso queira testar o envio de email para o recuperar senha:

    5.1 - Acesse: https://mailtrap.io/

    5.2 - Criar conta, criar projeto, selecionar Integrations (FuelPHP)

    5.3 - dentro do projeto, no arquivo connection.php, configure com as credenciais geradas pelo mailtrap:

    $hostServer = '????';

    $portServer = ????;

    $usernameServer = '????';

    $passwordServer = '????';
