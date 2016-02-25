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
 * Time: 9:19
 */

namespace Pixidos\PdfDocumentCreator\MPdf;
use Pixidos\PdfDocumentCreator\Exceptions\MPdfException;

/**
 * Class mPdf
 * @package Pixidos\PdfDocumentCreator
 * @author Ondra Votava <ondra.votava@pixidos.com>
 */

class MPdf extends \mPDF
{
    function Error($msg)
    {
        //Fatal error
        throw new MPdfException('mPDF error: '.$msg);
    }
}