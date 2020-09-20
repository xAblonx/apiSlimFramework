<?php
  if(PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
  }

  require __DIR__ . '/vendor/autoload.php';

  $settings = require __DIR__ . '/src/settings.php';
  $app = new \Slim\App($settings);

  require __DIR__ . '/src/dependencies.php';

  $db = $container->get('db');
  $schema = $db->schema();
  $tabela = 'produtos';
  $schema->dropIfExists($tabela);
  $schema->create($tabela, function($table) {
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->timestamps();
  });

  $db->table($tabela)->insert([
    'titulo' => 'Smartphone Motorola',
    'descricao' => 'Android Oreo',
    'preco' => 899.00,
    'fabricante' => 'Motorola',
    'created_at' => '2019-10-22',
    'updated_at' => '2019-10-22'
  ]);

  $db->table($tabela)->insert([
    'titulo' => 'iPhone X',
    'descricao' => 'IOS 12',
    'preco' => 4999.00,
    'fabricante' => 'Apple',
    'created_at' => '2020-01-10',
    'updated_at' => '2020-01-10'
  ]);
?>