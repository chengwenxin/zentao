<?php
/**
 * ZenTaoPHP的dao和sql类。
 * The dao and sql class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 * 
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

helper::import(dirname(dirname(__FILE__)) . '/base/dao/dao.class.php');
/**
 * DAO类。
 * DAO, data access object.
 * 
 * @package framework
 */
class dao extends baseDAO
{
    public function exec($sql = '')
    {
        if(isset($_SESSION['tutorialMode']) and $_SESSION['tutorialMode']) die();
        return parent::exec($sql);
    }

    public function data($data, $skipFields = '')
    {
        $skipFields .= ',uid';
        return parent::data($data, $skipFields);
    }
}

/**
 * SQL类。
 * The SQL class.
 * 
 * @package framework
 */
class sql extends baseSQL
{
    /**
     * 创建GROUP BY部分。
     * Create the groupby part.
     *
     * @param  string $groupBy
     * @access public
     * @return object the sql object.
     */
    public function groupBy($groupBy)
    {
        if($this->inCondition and !$this->conditionIsTrue) return $this;
        if(!preg_match('/^[a-zA-Z0-9_`\.,\s]+$/', $groupBy))
        {
            $groupBy = htmlspecialchars($groupBy);
            die("Group is bad query, The group is $groupBy");
        }
        $this->sql .= ' ' . DAO::GROUPBY . " $groupBy";
        return $this;
    }
}
