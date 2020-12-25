<?php


namespace Day16;


class Reader
{
    public function read(string $filepath): Data
    {
        $data = new Data();

        $validators = [];
        $yourTicket = [];
        $nearbyTickets = [];

        $section = 'ranges';
        foreach (file($filepath) as $line) {
            if (trim($line) === '') {
                continue;
            }
            if (preg_match('/your ticket:/', $line)) {
                $section = 'your_ticket';
                continue;
            }
            if (preg_match('/nearby tickets:/', $line)) {
                $section = 'nearby_tickets';
                continue;
            }

            switch ($section) {
                case 'ranges':
                    $validators[] = $this->getValidator($line);
                    break;
                case 'your_ticket':
                    $yourTicket = explode(',', $line);
                    break;
                case 'nearby_tickets':
                    $nearbyTickets[] = explode(',', $line);
                    break;
            }
        }

        $data->setValidators($validators);
        $data->setYourTicket($yourTicket);
        $data->setNearbyTickets($nearbyTickets);

        return $data;
    }

    private function getValidator(string $line): FieldValidator
    {
        $matches = [];
        preg_match('/([\w ]+): (\d+)-(\d+) or (\d+)-(\d+)/', $line, $matches);
        $name = $matches[1];

        return new FieldValidator($name, [
            [(int)$matches[2], (int)$matches[3]],
            [(int)$matches[4], (int)$matches[5]]
        ]);
    }
}