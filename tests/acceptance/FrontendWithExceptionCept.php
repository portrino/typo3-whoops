<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Open the frontend with error and see whoops error message.');

$I->amOnPage('page_not_found');
$I->see('Whoops! There was an error.');
