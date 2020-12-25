<?php


namespace Day16;


class Data
{
    public array $validators;
    public array $yourTicket;
    public array $nearbyTickets;

    /**
     * @return array
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    /**
     * @param array $validators
     */
    public function setValidators(array $validators): void
    {
        $this->validators = $validators;
    }

    /**
     * @return array
     */
    public function getYourTicket(): array
    {
        return $this->yourTicket;
    }

    /**
     * @param array $yourTicket
     */
    public function setYourTicket(array $yourTicket): void
    {
        $this->yourTicket = $yourTicket;
    }

    /**
     * @return array
     */
    public function getNearbyTickets(): array
    {
        return $this->nearbyTickets;
    }

    /**
     * @param array $nearbyTickets
     */
    public function setNearbyTickets(array $nearbyTickets): void
    {
        $this->nearbyTickets = $nearbyTickets;
    }
}