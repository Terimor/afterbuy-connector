<?php


namespace App\Supplier\Afterbuy\Request\GetSoldItems;


use JMS\Serializer\Annotation as Serializer;

class AfterbuyGlobalRequest
{
    /** @Serializer\Type("string") */
    private string $PartnerID;

    /** @Serializer\Type("string") */
    private string $PartnerPassword;

    /** @Serializer\Type("string") */
    private string $UserID;

    /** @Serializer\Type("string") */
    private string $UserPassword;

    /** @Serializer\Type("string") */
    private string $CallName;

    /** @Serializer\Type("int") */
    private int $DetailLevel;

    /** @Serializer\Type("string") */
    private string $ErrorLanguage;

    public function setPartnerID(string $PartnerID): void
    {
        $this->PartnerID = $PartnerID;
    }

    public function setPartnerPassword(string $PartnerPassword): void
    {
        $this->PartnerPassword = $PartnerPassword;
    }

    public function setUserID(string $UserID): void
    {
        $this->UserID = $UserID;
    }

    public function setUserPassword(string $UserPassword): void
    {
        $this->UserPassword = $UserPassword;
    }

    public function setCallName(string $CallName): void
    {
        $this->CallName = $CallName;
    }

    public function setDetailLevel(int $DetailLevel): void
    {
        $this->DetailLevel = $DetailLevel;
    }

    public function setErrorLanguage(string $ErrorLanguage): void
    {
        $this->ErrorLanguage = $ErrorLanguage;
    }
}