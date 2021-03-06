<?php

namespace Mpp\ApicilClientBundle\Model;

use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\Exception\NoSuchOptionException;
use Symfony\Component\OptionsResolver\Exception\OptionDefinitionException;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrigineDesFondsDto
{
    /**
     * @var float|null
     */
    private $ofAutre;

    /**
     * @var string|null
     */
    private $ofAutreCommentaire;

    /**
     * @var float|null
     */
    private $ofAutresPlacements;

    /**
     * @var float|null
     */
    private $ofBiensMobiliers;

    /**
     * @var float|null
     */
    private $ofCessionActifs;

    /**
     * @var float|null
     */
    private $ofRevenusPro;

    /**
     * @var float|null
     */
    private $ofSuccessionDonation;

    /**
     * @var float|null
     */
    private $ofVenteImmobiliere;

    /**
     * @param OptionsResolver $resolver
     */
    public static function configureData(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('ofAutre', null)->setAllowedTypes('ofAutre', ['float', 'null'])
            ->setDefault('ofAutreCommentaire', null)->setAllowedTypes('ofAutreCommentaire', ['string', 'null'])
            ->setDefault('ofAutresPlacements', null)->setAllowedTypes('ofAutresPlacements', ['float', 'null'])
            ->setDefault('ofBiensMobiliers', null)->setAllowedTypes('ofBiensMobiliers', ['float', 'null'])
            ->setDefault('ofCessionActifs', null)->setAllowedTypes('ofCessionActifs', ['float', 'null'])
            ->setDefault('ofRevenusPro', null)->setAllowedTypes('ofRevenusPro', ['float', 'null'])
            ->setDefault('ofSuccessionDonation', null)->setAllowedTypes('ofSuccessionDonation', ['float', 'null'])
            ->setDefault('ofVenteImmobiliere', null)->setAllowedTypes('ofVenteImmobiliere', ['float', 'null'])
        ;
    }

    /**
     * @param array $options
     *
     * @return self
     *
     * @throws UndefinedOptionsException If an option name is undefined
     * @throws InvalidOptionsException   If an option doesn't fulfill the language specified validation rules
     * @throws MissingOptionsException   If a required option is missing
     * @throws OptionDefinitionException If there is a cyclic dependency between lazy options and/or normalizers
     * @throws NoSuchOptionException     If a lazy option reads an unavailable option
     * @throws AccessException           If called from a lazy option or normalizer
     */
    public static function createFromArray(array $options): self
    {
        $resolver = new OptionsResolver();
        self::configureData($resolver);
        $resolvedOptions = $resolver->resolve($options);

        return (new self())
            ->setOfAutre($resolvedOptions['ofAutre'])
            ->setOfAutreCommentaire($resolvedOptions['ofAutreCommentaire'])
            ->setOfAutresPlacements($resolvedOptions['ofAutresPlacements'])
            ->setOfBiensMobiliers($resolvedOptions['ofBiensMobiliers'])
            ->setOfCessionActifs($resolvedOptions['ofCessionActifs'])
            ->setOfRevenusPro($resolvedOptions['ofRevenusPro'])
            ->setOfSuccessionDonation($resolvedOptions['ofSuccessionDonation'])
            ->setOfVenteImmobiliere($resolvedOptions['ofVenteImmobiliere'])
        ;
    }

    /**
     * @return float|null
     */
    public function getOfAutre(): ?float
    {
        return $this->ofAutre;
    }

    /**
     * @param float|null $ofAutre
     *
     * @return self
     */
    public function setOfAutre(?float $ofAutre): self
    {
        $this->ofAutre = $ofAutre;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOfAutreCommentaire(): ?string
    {
        return $this->ofAutreCommentaire;
    }

    /**setPortefeuille
     * @param string|null $ofAutreCommentaire
     *
     * @return self
     */
    public function setOfAutreCommentaire(?string $ofAutreCommentaire): self
    {
        $this->ofAutreCommentaire = $ofAutreCommentaire;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOfAutresPlacements(): ?float
    {
        return $this->ofAutresPlacements;
    }

    /**
     * @param float|null $ofAutresPlacements
     *
     * @return self
     */
    public function setOfAutresPlacements(?float $ofAutresPlacements): self
    {
        $this->ofAutresPlacements = $ofAutresPlacements;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOfBiensMobiliers(): ?float
    {
        return $this->ofBiensMobiliers;
    }

    /**
     * @param float|null $ofBiensMobiliers
     *
     * @return self
     */
    public function setOfBiensMobiliers(?float $ofBiensMobiliers): self
    {
        $this->ofBiensMobiliers = $ofBiensMobiliers;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOfCessionActifs(): ?float
    {
        return $this->ofCessionActifs;
    }

    /**
     * @param float|null $ofCessionActifs
     *
     * @return self
     */
    public function setOfCessionActifs(?float $ofCessionActifs): self
    {
        $this->ofCessionActifs = $ofCessionActifs;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOfRevenusPro(): ?float
    {
        return $this->ofRevenusPro;
    }

    /**
     * @param float|null $ofRevenusPro
     *
     * @return self
     */
    public function setOfRevenusPro(?float $ofRevenusPro): self
    {
        $this->ofRevenusPro = $ofRevenusPro;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOfSuccessionDonation(): ?float
    {
        return $this->ofSuccessionDonation;
    }

    /**
     * @param float|null $ofSuccessionDonation
     *
     * @return self
     */
    public function setOfSuccessionDonation(?float $ofSuccessionDonation): self
    {
        $this->ofSuccessionDonation = $ofSuccessionDonation;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOfVenteImmobiliere(): ?float
    {
        return $this->ofVenteImmobiliere;
    }

    /**
     * @param float|null $ofVenteImmobiliere
     *
     * @return self
     */
    public function setOfVenteImmobiliere(?float $ofVenteImmobiliere): self
    {
        $this->ofVenteImmobiliere = $ofVenteImmobiliere;

        return $this;
    }
}
