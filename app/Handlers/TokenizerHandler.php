<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Handlers;

use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use TeamTNT\TNTSearch\Support\TokenizerInterface;

/**
 * 全文索引集成中文分词服务
 *
 * Class TokenizerHandler
 * @package App\Handlers
 */
class TokenizerHandler implements TokenizerInterface
{
    public function __construct()
    {
        $options = config('scout.tntsearch.jieba');
        Jieba::init($options);
        Finalseg::init($options);
    }

    public function tokenize($text, $stopwords = [])
    {
        return is_numeric($text) ? [] : $this->getTokens($text, $stopwords);
    }

    public function getTokens($text, $stopwords = [])
    {
        $split = Jieba::cutForSearch($text);
        return $split;
    }
}
