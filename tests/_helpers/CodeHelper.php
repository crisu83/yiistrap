<?php
namespace Codeception\Module;

class CodeHelper extends \Codeception\Module
{
    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param string $text
     */
    public function seeNodeText($node, $text)
    {
        $this->assertTrue(strpos($node->text(), $text) !== false);
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param $pattern $text
     */
    public function seeNodePattern($node, $pattern)
    {
        $this->assertEquals(1, preg_match($pattern, $node->html()));
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     */
    public function seeNodeEmpty($node)
    {
        $this->assertEquals('', $node->text());
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param mixed $cssClass
     */
    public function seeNodeCssClass($node, $cssClass)
    {
        if (is_string($cssClass)) {
            $cssClass = explode(' ', $cssClass);
        }
        foreach ($cssClass as $className) {
            $this->assertTrue(in_array($className, explode(' ', $node->attr('class'))));
        }
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param mixed $cssClass
     */
    public function dontSeeNodeCssClass($node, $cssClass)
    {
        if (is_string($cssClass)) {
            $cssClass = explode(' ', $cssClass);
        }
        foreach ($cssClass as $className) {
            $this->assertFalse(in_array($className, explode(' ', $node->attr('class'))));
        }
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param string $cssStyle
     */
    public function seeNodeCssStyle($node, $cssStyle)
    {
        if (is_string($cssStyle)) {
            $cssStyle = explode(';', rtrim($cssStyle, ';'));
        }
        $cssStyle = $this->normalizeCssStyle($cssStyle);
        foreach ($cssStyle as $style) {
            $this->assertTrue(strpos($node->attr('style'), $style) !== false);
        }
    }

    /**
     * @param array $cssStyle
     * @return array
     */
    protected function normalizeCssStyle(array $cssStyle)
    {
        array_walk(
            $cssStyle,
            function (&$value) {
                $value = trim($value);
            }
        );
        return $cssStyle;
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param string $cssStyle
     */
    public function dontSeeNodeCssStyle($node, $cssStyle)
    {
        if (is_string($cssStyle)) {
            $cssStyle = explode(';', rtrim($cssStyle, ';'));
        }
        $cssStyle = $this->normalizeCssStyle($cssStyle);
        foreach ($cssStyle as $style) {
            $this->assertFalse(strpos($node->attr('style'), $style));
        }
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param string $name
     * @param string $value
     */
    public function seeNodeAttribute($node, $name, $value = null)
    {
        $attr = $node->attr($name);
        $this->assertTrue($attr !== null);
        if ($value !== null) {
            $this->assertEquals($value, $attr);
        }
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param array $attributes
     */
    public function seeNodeAttributes($node, array $attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->seeNodeAttribute($node, $name, $value);
        }
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param array $elements
     */
    public function seeNodeChildren($node, array $elements)
    {
        /** @var \DomElement $child */
        foreach ($node->children() as $i => $child) {
            $this->assertTrue($this->nodeMatchesCssSelector($child, $elements[$i]));
        }
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param array $elements
     */
    public function dontSeeNodeChildren($node, array $elements)
    {
        /** @var \DomElement $child */
        foreach ($node->children() as $i => $child) {
            $this->assertFalse($this->nodeMatchesCssSelector($child, $elements[$i]));
        }
    }

    /**
     * @param \DomElement $node
     * @param string $selector
     * @return boolean
     */
    protected function nodeMatchesCssSelector($node, $selector)
    {
        if ($node->parentNode === null) {
            return false;
        }
        $crawler = $this->createNode($node->parentNode);
        return count($crawler->filter($selector)) > 0;
    }

    /**
     * @param mixed $content
     * @param string $selector
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    public function createNode($content, $selector = null)
    {
        $crawler = new \Symfony\Component\DomCrawler\Crawler;
        $crawler->add($content);
        if ($selector !== null) {
            $node = $crawler->filter($selector);
            $this->assertNotEquals(null, $node);
            return $node;
        }
        return $crawler;
    }
}
