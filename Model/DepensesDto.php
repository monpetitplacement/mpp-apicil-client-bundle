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

class DepensesDto
{
    /**
     * @param OptionsResolver $resolver
     */
    public static function configureData(OptionsResolver $resolver)
    {
        return;
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

        return new self();
    }
}
