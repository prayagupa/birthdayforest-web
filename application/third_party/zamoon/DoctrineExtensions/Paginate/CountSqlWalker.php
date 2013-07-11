<?php

namespace F1soft\DoctrineExtensions\Paginate;

use Doctrine\ORM\Query\TreeWalkerAdapter,
	Doctrine\ORM\Query\AST as AST;

class CountSqlWalker extends TreeWalkerAdapter
{
    /**
     * Walks down a SelectStatement AST node, thereby generating the appropriate SQL.
     *
     * @return string The SQL.
     */
    public function walkSelectStatement(AST\SelectStatement $AST)
    {
        $parent = null;
        $parentName = null;
        foreach ($this->_getQueryComponents() AS $dqlAlias => $qComp) {
            if ($qComp['parent'] === null && $qComp['nestingLevel'] == 0) {
                $parent = $qComp;
                $parentName = $dqlAlias;
                break;
            }
        }

        $pathExpression = new AST\PathExpression(
            AST\PathExpression::TYPE_STATE_FIELD | AST\PathExpression::TYPE_SINGLE_VALUED_ASSOCIATION, $parentName,
            $parent['metadata']->getSingleIdentifierFieldName()
        );
        $pathExpression->type = AST\PathExpression::TYPE_STATE_FIELD;

        $AST->selectClause->selectExpressions = array(
            new AST\SelectExpression(
                new AST\AggregateExpression('count', $pathExpression, true), null
            )
        );
		$AST->selectClause->groupExpressions = NULL;
    }
}