<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BookAuthor]].
 *
 * @see BookAuthor
 */
class BookAuthorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BookAuthor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BookAuthor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
