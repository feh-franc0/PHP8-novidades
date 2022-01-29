<?php

// Link: https://www.php.net/releases/8.0/pt_BR.php

//* PHP 8.0 é uma atualização importante da linguagem PHP.
// TODO: Ela contém muitos novos recursos e otimizações, incluindo argumentos nomeados, união de tipos, atributos, promoção de propriedade do construtor, expressão match, operador nullsafe, JIT e melhorias no sistema de tipos, tratamento de erros e consistência.




//* ARGUMENTOS NOMEADOS //

//! ----- PHP7 -----
// htmlspecialchars($string, ENT_COMPAT | ENT_HTML401, 'UTF-8', false);

//! ----- PHP8 -----
// htmlspecialchars($string, double_encode: false);

// ?Especifique apenas os parâmetros obrigatórios, pulando os opcionais.
// ?Os argumentos são independentes da ordem e autodocumentados.

//---------------------------------------------------------


//* ATRIBUTOS

//! ----- PHP7 -----
// class PostsController
// {
//     /**
//      * @Route("/api/posts/{id}", methods={"GET"})
//      */
//     public function get($id) { /* ... */ }
// }

//! ----- PHP8 -----
// class PostsController
// {
//     #[Route("/api/posts/{id}", methods: ["GET"])]
//     public function get($id) { /* ... */ }
// }

//? Em vez de anotações PHPDoc, agora você pode usar metadados estruturados com a sintaxe nativa do PHP.

//---------------------------------------------------------


//* PROMOÇÃO DE PROPRIEDADE DE CONSTRUTOR

//! ----- PHP7 -----
// class Point {
//     public float $x;
//     public float $y;
//     public float $z;
  
//     public function __construct(
//       float $x = 0.0,
//       float $y = 0.0,
//       float $z = 0.0
//     ) {
//       $this->x = $x;
//       $this->y = $y;
//       $this->z = $z;
//     }
//   }

//! ----- PHP8 -----
// class Point {
//     public function __construct(
//       public float $x = 0.0,
//       public float $y = 0.0,
//       public float $z = 0.0,
//     ) {}
//   }

//? Menos código boilerplate para definir e inicializar propriedades.

//---------------------------------------------------------


//* UNIÃO DE TIPOS

//! ----- PHP7 -----
// class Number {
//   /** @var int|float */
//   private $number;

//   /**
//    * @param float|int $number
//    */
//   public function __construct($number) {
//     $this->number = $number;
//   }
// }

// new Number('NaN'); // Ok

//! ----- PHP8 -----
// class Number {
//   public function __construct(
//     private int|float $number
//   ) {}
// }

// new Number('NaN'); // TypeError

//? Em vez de anotações PHPDoc para uma combinação de tipos, você pode usar declarações de união de tipos nativa que são validados em tempo de execução.

//---------------------------------------------------------


//* EXPRESSÃO MATCH

//! ----- PHP7 -----
// case '8.0':
//     $result = "Oh no!";
//     break;
//   case 8.0:
//     $result = "This is what I expected";
//     break;
// }
// echo $result;
// //> Oh no!

//! ----- PHP8 -----
// echo match (8.0) {
//     '8.0' => "Oh no!",
//     8.0 => "This is what I expected",
//   };
//   //> This is what I expected

//? A nova expressão match é semelhante ao switch e tem os seguintes recursos:
//? @Match é uma expressão, o que significa que seu resultado pode ser armazenado em uma variável ou retornado.
//? @Match suporta apenas expressões de uma linha e não precisa de uma declaração break;.
//? @Match faz comparações estritas.

//---------------------------------------------------------


//* OPERADOR NULLSAFE

//! ----- PHP7 -----
// $country =  null;

// if ($session !== null) {
//   $user = $session->user;

//   if ($user !== null) {
//     $address = $user->getAddress();
 
//     if ($address !== null) {
//       $country = $address->country;
//     }
//   }
// }

//! ----- PHP8 -----
// $country = $session?->user?->getAddress()?->country;

//? Em vez de verificar condições nulas, agora você pode usar uma cadeia de chamadas com o novo operador nullsafe. Quando a avaliação de um elemento da cadeia falha, a execução de toda a cadeia é abortada e toda a cadeia é avaliada como nula.

//---------------------------------------------------------


//* COMPARAÇÕES MAIS INTELIGENTES ENTRE STRING E NÚMEROS

//! ----- PHP7 -----
// 0 == 'foobar' // true

//! ----- PHP8 -----
// 0 == 'foobar' // false

//? Ao comparar com uma string numérica, o PHP 8 usa uma comparação numérica. Caso contrário, ele converte o número em uma string e usa uma comparação de string.

//---------------------------------------------------------


//* ERROS CONSISTENTES PARA TIPOS DE DADOS EM FUNÇÕES INTERNAS

//! ----- PHP7 -----
// strlen([]); // Warning: strlen() expects parameter 1 to be string, array given

// array_chunk([], -1); // Warning: array_chunk(): Size parameter expected to be greater than 0

//! ----- PHP8 -----
// strlen([]); // TypeError: strlen(): Argument #1 ($str) must be of type string, array given

// array_chunk([], -1); // ValueError: array_chunk(): Argument #2 ($length) must be greater than 0

//? A maioria das funções internas agora lançam uma exceção Error se a validação do parâmetro falhar.

//---------------------------------------------------------


//* COMPILÇÃO JUST-IN-TIME