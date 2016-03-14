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
 * Date: 12.03.2016
 * Time: 17:12
 */

namespace Pixidos\PdfDocumentCreator;

/**
 * Class Margin
 * @package Pixidos\InvoicePdfCreator
 * @author Ondra Votava <ondra.votava@pixidos.com>
 */

class Margin
{

    public $left   = 15;
    public $right  = 15;
    public $top    = 15;
    public $bottom = 15;
    public $header = 15;
    public $footer = 15;

    /**
     * @return int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param int $left
     * @return Margin
     */
    public function setLeft($left)
    {
        $this->left = $left;

        return $this;
    }

    /**
     * @return int
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param int $right
     * @return Margin
     */
    public function setRight($right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * @return int
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param int $top
     * @return Margin
     */
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }

    /**
     * @return int
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * @param int $bottom
     * @return Margin
     */
    public function setBottom($bottom)
    {
        $this->bottom = $bottom;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param int $header
     * @return Margin
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @return int
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * @param int $footer
     * @return Margin
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }



}