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
 * Date: 24.02.2016
 * Time: 8:08
 */

namespace Pixidos\PdfDocumentCreator;
use Pixidos\PdfDocumentCreator\Exceptions\PdfDocumentCreatorExceptions;

/**
 * Class DocumentCreatorSetting
 * @package Pixidos\PdfDocumentCreator
 * @author Ondra Votava <ondra.votava@pixidos.com>
 */

class DocumentCreatorSetting
{
    private $tempDir;
    private $documentDir;

    private $encoding;
    private $img_dpi;
    private $size;
    private $orientation;
    private $margin;

    public function __construct($pdfSetting)
    {

        $this->tempDir = $pdfSetting['tempDir'];
        if ( ! is_writable($this->tempDir)){
            throw new PdfDocumentCreatorExceptions($this->tempDir . ' must by writable');
        }

        $this->documentDir = $pdfSetting['documentDir'];
        if ( ! is_writable($this->documentDir)){
            throw new PdfDocumentCreatorExceptions($this->documentDir . ' must by writable');
        }

        $this->orientation = $pdfSetting['orientation'];
        $this->encoding = $pdfSetting['encoding'];

        $this->img_dpi = $pdfSetting['img_dpi'];

        $this->size = $pdfSetting['size'];

        $this->margin = $pdfSetting['margin'];
    }

    /**
     * @return string
     */
    public function getTempDir()
    {
        return $this->tempDir;
    }

    /**
     * @return string
     */
    public function getDocumentDir()
    {
        return $this->documentDir;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @return mixed
     */
    public function getImgDpi()
    {
        return $this->img_dpi;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getMargin()
    {
        return $this->margin;
    }

}