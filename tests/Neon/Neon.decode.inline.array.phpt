<?php

/**
 * Test: Nette\Neon\Neon::decode inline hash and array.
 *
 * @author     David Grudl
 */

use Nette\Neon\Neon,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


Assert::same( array(
	'foo' => 'bar',
), Neon::decode('{"foo":"bar"}') );


Assert::same( array(
	TRUE, 'tRuE', TRUE, FALSE, FALSE, TRUE, TRUE, FALSE, FALSE, NULL, NULL,
), Neon::decode('[true, tRuE, TRUE, false, FALSE, yes, YES, no, NO, null, NULL,]') );


Assert::same( array(
	'false' => FALSE,
	'on' => TRUE,
	-5 => 1,
	'5.3' => 1,
), Neon::decode('{false: off, "on": true, -5: 1, 5.3: 1}') );


Assert::same( array(
	0 => 'a',
	1 => 'b',
	2 => array(
		'c' => 'd',
	),
	'e' => 'f',
	'g' => NULL,
	'h' => NULL,
), Neon::decode('{a, b, {c: d}, e: f, g:,h:}') );


Assert::same( array(
	'a',
	'b',
	'c' => 1,
	'd' => 1,
	'e' => 1,
	'f' => NULL,
), Neon::decode("{a,\nb\nc: 1,\nd: 1,\n\ne: 1\nf:\n}") );


Assert::type( 'Nette\Neon\Entity', Neon::decode('@item(a, b)') );


Assert::same( array(
	'value' => '@item',
	'attributes' => array('a', 'b'),
), (array) Neon::decode('@item(a, b)') );


Assert::same( array(
	'value' => '@item<item>',
	'attributes' => array('a', 'b'),
), (array) Neon::decode('@item<item>(a, b)') );


Assert::same( array(
	'value' => 'item',
	'attributes' => array('a', 'b'),
), (array) Neon::decode('item (a, b)') );


Assert::same( array(
	'value' => array(),
	'attributes' => array(),
), (array) Neon::decode('[]()') );
