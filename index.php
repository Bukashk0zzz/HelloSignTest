<?php
/*
 * This file is part of the HelloSignTest
 *
 * (c) Denis Golubovskiy <bukashk0zzz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

include_once 'vendor/autoload.php';

$config = include_once('config.php');
$client_key = $config['client_key'];
$client_id = $config['client_id'];

$client = new HelloSign\Client($client_key);

$request = new HelloSign\Template();
$request->enableTestMode();
$request->setClientId($client_id);
$request->addFile('example_document.pdf');
$request->setTitle('Test Title');
$request->setSubject('Test Subject');
$request->setMessage('Test Message');
$request->addSignerRole('First Role');
$request->addSignerRole('Second Role');

$response = $client->createEmbeddedDraft($request);

$new_template_id = $response->getId();
$edit_url = $response->getEditUrl();
$is_embedded_draft = $response->isEmbeddedDraft();

dump($new_template_id, $edit_url, $is_embedded_draft);
