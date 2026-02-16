<?php

namespace Customize\Entity;

#DBにアクセスするためのライブラリなどを読み込み
use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation as Eccube;
use Eccube\Entity\Customer;

#拡張をする対象エンティティの指定
/**
 * @Eccube\EntityExtension("Eccube\Entity\Customer")
 */
trait CustomerTrait //ファイル名と合わせる
{
    //ココに実際の拡張内容などを記述していきます

    /**
     * VeriTrans4G2 プラグイン用会員ID（プラグイン削除後も参照エラー回避のため保持）
     *
     * @var string|null
     * @ORM\Column(name="vt4g_account_id", type="string", length=255, nullable=true)
     */
    public $vt4g_account_id;

    /**
     * @ORM\Column(name="mail_magazine",type="boolean",nullable=false,options={"default":false})
     */
    public $mail_magazine;



    /**
     * Set lastBuyDate.
     *
     * @param boolean $mailMagazine
     *
     * @return Customer
     */
    public function setMailMagazine($mailMagazine = false)
    {
        $this->mail_magazine = $mailMagazine;

        return $this;
    }

    /**
     * Get mailMagazine.
     *
     * @return boolean
     */
    public function getMailMagazine()
    {
        return $this->mail_magazine;
    }

    /**
     * Set vt4g_account_id.
     *
     * @param string|null $vt4gAccountId
     * @return Customer
     */
    public function setVt4gAccountId($vt4gAccountId = null)
    {
        $this->vt4g_account_id = $vt4gAccountId;

        return $this;
    }

    /**
     * Get vt4g_account_id.
     *
     * @return string|null
     */
    public function getVt4gAccountId()
    {
        return $this->vt4g_account_id;
    }

}
