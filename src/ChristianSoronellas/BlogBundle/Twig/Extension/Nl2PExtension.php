<?php

namespace ChristianSoronellas\BlogBundle\Twig\Extension;

/**
 * A Twig extension to transform new line characters to HTML paragraphs
 *
 * @author Christian Soronellas <christian@sistemes-cayman.es>
 */
class Nl2PExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'nl2p' => new \Twig_Filter_Method($this, 'transformNewLinesToParagraphs')
        );
    }
    
    public function transformNewLinesToParagraphs($string)
    {
        return preg_replace('/(.*)(\r)?(\n)?/', '<p>$1</p>', $string);
    }
    
    public function getName()
    {
        return 'christiansoronellas_blogbundle_twigextensions';
    }
}