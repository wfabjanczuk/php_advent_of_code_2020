<?php


namespace Day16;


class TicketsCleaner
{
    private array $validators;

    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    public function clean(array $tickets): array
    {
        $validTickets = [];
        foreach ($tickets as $ticket) {
            if ($this->isTicketValid($ticket)) {
                $validTickets[] = $ticket;
            }
        }
        return $validTickets;
    }

    private function isTicketValid(array $ticket): bool
    {
        foreach ($ticket as $value) {
            $error = true;
            foreach ($this->validators as $validator) {
                if ($validator->validate((int)$value)) {
                    $error = false;
                }
            }
            if ($error) {
                return false;
            }
        }
        return true;
    }
}