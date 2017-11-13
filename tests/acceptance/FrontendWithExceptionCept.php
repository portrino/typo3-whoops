<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Open the frontend with error and see whoops error message.');

$I->amOnPage('index.php?id=123');
$I->seeInTitle('Whoops! There was an error.');
$I->seeElement('.Whoops');
