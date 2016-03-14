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
 * Time: 8:09
 */

namespace Pixidos\PdfDocumentCreator;

use Pixidos\PdfDocumentCreator\Exceptions\PdfDocumentCreatorExceptions;
use Pixidos\PdfDocumentCreator\MPdf\MPdf;

/**
 * Class PdfDocumentCreatorProcesor
 * @package Pixidos\PdfDocumentCreator
 * @author Ondra Votava <ondra.votava@pixidos.com>
 */
class PdfDocumentCreatorProcesor
{
    /**
     * @var DocumentCreatorSetting $setting
     */
    private $setting;
    /**
     * @var MPdf $mpdf
     */
    private $mpdf;

    public function __construct(DocumentCreatorSetting $setting)
    {
        $this->setting = $setting;

        $tmpDir = $setting->getTempDir() . '/mpdf/tmp/';
        $fontDir = $setting->getTempDir() . '/mpdf/font/';

        if (!is_dir($tmpDir)) mkdir($tmpDir, 0777, TRUE);
        if (!is_dir($fontDir)) mkdir($fontDir, 0777, TRUE);

        define("_MPDF_TEMP_PATH", $tmpDir);
        define("_MPDF_TTFONTDATAPATH", $fontDir);

       $this->mpdf = new MPdf($setting->getEncoding(), $setting->getSize());
    //    $this->mpdf = new MPdf('utf-8', 'A4');
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->img_dpi = $setting->getImgDpi();
      //  $this->mpdf->autoScriptToLang = TRUE;

        $this->mpdf->showImageErrors = TRUE;
      //  $this->mpdf->setAutoTopMargin = 'stretch';

        $this->setMargin($setting->getMargin());

    }


    /**
     * @param Margin $array
     * @return $this
     */
    public function setMargin(Margin $array)
    {

        $mpdf = $this->mpdf;

        $mpdf->orig_lMargin = $mpdf->DeflMargin = $array->left;

        $mpdf->orig_rMargin = $mpdf->DefrMargin = $array->right;

        $mpdf->orig_tMargin = $mgt = $array->top;

        $mpdf->orig_bMargin = $mgt = $array->bottom;

        $mpdf->orig_hMargin = $mgt = $array->header;

        $mpdf->orig_fMargin = $mgt = $array->footer;

        return $this;
    }

    /**
     * Use P for portait or L for Landscape
     * @param string $orientation
     * @throws PdfDocumentCreatorExceptions
     */
    public function setOrientation($orientation)
    {
        if (strtolower($orientation) == 'p' || strtolower($orientation) == 'portait' )
            $or = 'P';
        elseif (strtolower($orientation) == 'l' || strtolower($orientation) == 'landscape' )
            $or = 'L';
        else {
            throw new PdfDocumentCreatorExceptions('Orientatation must by "P" or "Portait" or "L" or "Landscape" ' . (string)$orientation . ' given');
        }
        $this->mpdf->_setPageSize($this->setting->getSize(), $or);
    }

    /**
     * @param string $html
     * @param string $file
     * @return $this
     * @throws PdfDocumentCreatorExceptions
     */
    public function createPdfDocumentFile($html, $file)
    {
        $filePattern = "/[a-z1-9 \-_\.]+$/i";

        preg_match($filePattern, $file, $match);
        $fileName = $match[0];

        // file must end .pdf extension
        if (! preg_match("/\.pdf$/i", $fileName, $match))
            throw new PdfDocumentCreatorExceptions('File extension must by .pdf ' . strtolower($match[0]) . ' given');

        $path = preg_replace($filePattern, '', $file, 1); // remove file name from path

        if ($path != '') {
            if (!is_dir($path) && !is_writable($path))
                throw new PdfDocumentCreatorExceptions($path . ' in not directory or not writable');
        } else {
            $path = $this->setting->getDocumentDir() . DIRECTORY_SEPARATOR;
        }

        $output = $path . $fileName;

        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($output, 'F');

        return $this;
    }

    public function createPdfDocumentString($html)
    {
        $this->mpdf->WriteHTML($html);

        return $this->mpdf->Output('', 'S');
    }

    /**
     * @return MPdf
     */
    public function getMPdf()
    {
        return $this->mpdf;
    }


}