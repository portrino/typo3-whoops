<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Open the frontend');

$I->amOnPage('');
$I->seeInTitle('TYPO3');
