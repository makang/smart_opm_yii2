<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpmOpSystemNotice]].
 *
 * @see OpmOpSystemNotice
 */
class OpmOpSystemNoticeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return OpmOpSystemNotice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OpmOpSystemNotice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
