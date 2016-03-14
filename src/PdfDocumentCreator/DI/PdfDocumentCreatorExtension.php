<?php
/**
 * This file is part of the Pixidos (http://www.pixidos.com)
 *
 * Copyright (c) 2016 Ondra Votava Pixidos LTD  (ondra.votava@pixidos.com)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 *
 */

/**
 * Created by PhpStorm.
 * User: Ondra Votava
 * Date: 22.02.2016
 * Time: 18:20
 */

namespace Pixidos\PdfDocumentCreator\DI;

use Nette;
use Kdyby\Translation;
use Nette\DI\CompilerExtension;
use Nette\Utils\Validators;

/**
 * Class InvoicePdfCreatorExtension
 * @package Pixidos\InvoicePdfCreator\DI
 * @author Ondra Votava <ondra.votava@pixidos.com>
 */
class PdfDocumentCreatorExtension extends CompilerExtension
{

    public $defaults = [
        'encoding' => 'utf-8',
        'img_dpi' => 120,
        'size' => 'A4',
        'orientation' => 'P',
        'margin' => array(),
    ];


    public function loadConfiguration()
    {

        $config = array_merge($this->defaults, $this->getConfig());
        $config = $this->getConfig($this->defaults);

        Validators::assertField($config, 'tempDir');
        Validators::assertField($config, 'documentDir');
        Validators::assertField($config, 'encoding');
        Validators::assertField($config, 'img_dpi');
        Validators::assertField($config, 'size');
        Validators::assertField($config, 'orietation');
        Validators::assertField($config, 'orientation');
        Validators::assertField($config, 'margin');


        $builder = $this->getContainerBuilder();


        $builder->addDefinition($this->prefix('settings'))
            ->setClass('Pixidos\PdfDocumentCreator\DocumentCreatorSetting', $config);

        $builder->addDefinition($this->prefix('default'))
            ->setClass('Pixidos\PdfDocumentCreator\PdfDocumentCreatorProcesor');
    }


    public static function register(Nette\Configurator $configurator)
    {
        $configurator->onCompile[] = function ($config, Nette\DI\Compiler $compiler) {
            $compiler->addExtension('PdfDocumentCreator', new PdfDocumentCreatorExtension);
        };
    }
}