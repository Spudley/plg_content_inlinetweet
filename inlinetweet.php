<?php
/**
 * @package   Inlinetweet
 * @type      Plugin (Content)
 * @version   1.0.0
 * @author    Simon Champion
 * @copyright (C) 2016 Simon Champion
 * @license   GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;

class plgContentInlinetweet extends JPlugin
{
    public function onContentPrepare($context, &$article, &$params, $limitstart)
    {
        $regex = '#\{inlinetweet(( [a-z]+=".*?")*)\}(.*?)\{\/inlinetweet\}#s';

        $article->text = preg_replace_callback($regex, [$this, 'replace'], $article->text);
    }

    protected function replace($matches)
    {
        list($whole, $argsString, $lastArg, $text) = $matches;

        $attributes = $this->processArgs($argsString);

        return trim($this->inlineTweetString($text, $attributes));
    }

    /**
     * Set defaults for each attr from plugin config; override if arguments specified.
     * @return string the finished attributes string.
     */
    protected function processArgs($argsString)
    {
        $attrs = [
            "via" => $this->params['defaultVia'],
            "hashtags" => $this->params['defaultTags'],
            "url" => $this->params['defaultURL'],
        ];

        preg_match_all('#([a-z]+)="(.*?)"#', $argsString, $matches);
        foreach ($matches[1] as $pos=>$argName) {
            $argVal = $matches[2][$pos];
            if (array_key_exists($argName, $attrs)) {
                $attrs[$argName] = $argVal;
            }
        }
        if ($attrs['url'] === '' || $attrs['url'] === '.') {
            $attrs['url'] = JURI::current();
        }
        if ($attrs['url'] === '-') {
            $attrs['url'] = '';
        }

        return $attrs;
    }

    protected function inlineTweetString($text, $attrs)
    {
        $args = '';
        foreach ($attrs as $key => $attr) {
            if ($attr) {
                $args .= "&{$key}=".htmlentities($attr);
            }
        }

        return <<<eof
<a target="_blank" href="https://twitter.com/intent/tweet/?text={$text}{$args}"><span>{$text}</span><img src="/plugins/content/inlinetweet/assets/Twitter_Logo_Blue.png" style="width:1.6em;"></a>
eof;
    }
}
