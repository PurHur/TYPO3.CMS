<?php
namespace TYPO3\CMS\Frontend\Tests\Functional\Tca;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Tests\Functional\Form\FormTestService;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DomainVisibleFieldsTest extends \TYPO3\TestingFramework\Core\Functional\FunctionalTestCase
{
    protected static $domainFields = [
        'hidden',
        'domainName',
        'redirectTo',
        'redirectHttpStatusCode',
        'prepend_params'
    ];

    /**
     * @test
     */
    public function domainFormContainsExpectedFields()
    {
        $this->setUpBackendUserFromFixture(1);
        $GLOBALS['LANG'] = GeneralUtility::makeInstance(LanguageService::class);

        $formEngineTestService = GeneralUtility::makeInstance(FormTestService::class);
        $formResult = $formEngineTestService->createNewRecordForm('sys_domain');

        foreach (static::$domainFields as $expectedField) {
            $this->assertNotFalse(
                $formEngineTestService->formHtmlContainsField($expectedField, $formResult['html']),
                'The field ' . $expectedField . ' is not in the form HTML'
            );
        }
    }
}
