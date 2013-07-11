<?php
namespace models;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass="models\repository\InvoiceRepository")
 * @ORM\Table(name="Invoice")
 */


class Invoice {

    protected $id;

    protected $fiscalYear;

    protected $gateway;

    protected $created;

    protected $quantity;

    protected $rate;

    protected $taxAmount;

    protected $printStatus;

    protected $customerVatPan;

    private function Validate()
    {

    }
    public function __construct()
    {
        parent::__construct();
        $this->fiscal_year = "2069/70";
    }

    public function setInvoiceId($invoiceId)
    {
        $this->invoice_id = $invoiceId;

        return $this;
    }

    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    public function setFiscalYear($fiscalYear)
    {
        $this->fiscal_year = $fiscalYear;

        return $this;
    }

    public function getFiscalYear()
    {
        return $this->fiscal_year;
    }

    public function setGateway($gateway)
    {
        $this->gateway = $gateway;

        return $this;
    }

    public function getGateway()
    {
        return $this->gateway;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setTaxAmount($taxAmount)
    {
        $this->tax_amount = $taxAmount;

        return $this;
    }

    public function getTaxAmount()
    {
        return $this->tax_amount;
    }

    public function setPrintStatus($printStatus)
    {
        $this->print_status = $printStatus;

        return $this;
    }

    public function getPrintStatus()
    {
        return $this->print_status;
    }

    public function setCustomerVatPan($customerVatPan)
    {
        $this->customer_vat_pan = $customerVatPan;

        return $this;
    }

    public function getCustomerVatPan()
    {
        return $this->customer_vat_pan;
    }

}
?>