

# O que é o JWT
<p>JWT ou Json Web Token é um pacote utilizavel com Composer do PHP</p>
<p>Ele serve para autenticação das mais variadas maneiras possíveis</p>
<p>JWT é a opção mais utilizada pelos desenvolvedores por conta da sua segurança</p>
<p>Como todo sistema tem um 'crack', o pacote JWT também pode apresentar falhas em sua segurança</p>
<p>Como o nome já diz, ele gera um token de seguraça (JSON) a partir de um estrutura que pode ser decodificada com sua KEY </p>

<h1>Onde posso guardar o JWT</h1>
Uma pergunta frequente, depois de codificar o JSON ele pode ser guardado em muitos lugares
JWT é um token temporário então por sua via, não é possível guardar em uma database por exemplo
O mais recomendado é utilizar o JWT como uma maneira de autenticação, ou seja, guardar em $_COOKIE, em $_SESSION ou em localStorage
<h2>Exemplo</h2>
Em um sistema de login, o token é guardado em cookie, para verificar se o usuário está cadastrado, posso verificar se existe o cookie. E se eu precisar do token do usuário e pegar alguma informação dele? Fácil, pego o cookie e decodifico o Token

<h1>Instalação</h1>
Para instalar é um tanto quanto fácil para quem já teve contato com Composer, caso contrario, irei ensinar aqui mesmo. Para começar, precisamos do <a href="https://php.net/">PHP</a> e do <a href="https://getcomposer.org/">Composer</a>, após a instalação dos componentes, baixe o pacotes do JWT <a href="https://packagist.org/packages/firebase/php-jwt">conferindo aqui</a><br>
<br>

```composer
composer require firebase/jwt-php
```
Use o comando em cima na pasta do seu projeto!

<h1>Estrutura, codificação e decodificação</h1>
Iniciando pela estrutura, o JWT é composto de 3 partes: Header, Payload e Signature. 
O Payload, também conhecido como 'corpo do JWT' é a única parte que mexemos, e é nessa parte onde vai nosso array PHP com as informações
<h2>Exemplo</h2>

```php
    $Payload = [
        "Informações do Cliente" => [
            "Username" => "ofmxtheuz",
            "Realname" => "Matheus"
        ],
        "Informacoes do JWT" => [
            "Data do JWT" => date('d/m/Y');
        ];
    ];
    
```

<br>
Nesse exemplo, criei um array chamado Payload e coloquei minhas informações, ao codificar, essa array irá se tornar um código...
<br>
O JWT existe em várias versões e algoritmos, nessa versão e nesse algoritmo (RS256), usamos a Public Key para decodificar o token e a Private Key para codificar
Essas keys são definidas por nós, além de poder mudar elas a cada projeto. Nesse repositório o lugar para colocar as keys estão em 'Key/private.pem' e 'Key/public.pem'

<h1>Começando com JWT</h1>
Para começar, basta seguir os passos a seguir...

<h3>Primeiro passo</h3>

```php
require __DIR__ . '/vendor/autoload.php';
```

<h3>Segundo passo</h3>
Quando estamos falando de Composer, o primeiro passo é incluir o autoload no projeto!

```php
use Firebase\JWT\JWT;
```

Fazemos isso para 'usar' o JWT, em alguns algoritmos é necessário utilizar Firebase\JWT\Key;

<h3>Quarto passo</h3>
Vamos pegar nossas Keys utilizando o file_get_contents

```php
$Token = new stdClass();
$Token->public = file_get_contents("http://localhost/JWT/Key/public.pem");
$Token->private = file_get_contents("http://localhost/JWT/Key/private.pem");
```

<h3>Quinto passo</h3>
Vamos criar nosso payload!

```php
$payload = [
        "InformationAccount" => [
            "ID" => rand(11495, 59512),
            "Username" => 'ofmxtheuz'
        ],
        "InfomationJWT" => [
            "Open" => date("d-m-Y H:i:s"),
            "Expire" => date('d-m-Y H:i:s', strtotime('+1 days'))
        ]
    ];
```

<h3>Sexto passo</h3>
Agora sim, vamos de fato criar nosso token a partir do payload que acabamos de criar

```php
$TokenJWT = JWT::encode($payload, $Token->private, 'RS256');
```

Como primeiro parâmetro, passamos o payload, como segundo, passamos nossa Private Key, e no terceiro, passamos o algoritmo que iremos utilizar!
Temos o token, $TokenJWT, agora você pode armazenar esse token em um cookie por exemplo, ou no localStorage


<h3>Sétimo passo</h3>
Vamos fazer a decodificação do token!

```php
$Decode = decode($SeuTokenCodificado, $Token->public);
```

Por primeiro parâmetro, passamos o token codificado, já por segundo, passamos a Public Key
<br>
<br>
<br>

E agora sim! Entendemos, instalamos, codificamos e decodificamos o JWT

<h2>Observações Finais</h2>
Caso queira ver um pouco mais na prática do JWT, <a href="https://jwt.io/#debugger-io">Entre nesse site e crie seus JWTs</a><br>
Perdão por qualquer erro de escrita, já é madrugada e eu estou com muito sono hehe<br>
Caso tenha achado algum erro ou tenha ocorrido algum problema com seu código, me chame no discord: call me mx#9856<br>
Recomendo altamente que não coloque informações muito privadas como a senha do usuário dentro do payload, coloque informações de identificação como ID<br>
<a href="https://jwt.io/">Site Oficial JWT</a><br>
<br>
Mas no geral, bom código a todos!<br>
<span>Repositório feito por Matheus</span>
