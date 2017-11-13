<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Open the frontend without errors and see everything is fine.');

$I->amOnPage('');
$I->seeInTitle('TYPO3');
